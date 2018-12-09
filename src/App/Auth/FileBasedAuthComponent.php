<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Auth;

  use Funivan\CabbageFramework\Auth\AuthComponentInterface;
  use Funivan\CabbageFramework\Auth\UserInterface;
  use Funivan\Gallery\App\Users\UsersInterface;
  use Funivan\Gallery\FileStorage\File\File;
  use Funivan\Gallery\FileStorage\File\FileInterface;
  use Funivan\Gallery\FileStorage\FileStorageInterface;
  use Funivan\Gallery\FileStorage\Fs\BlackHole\BlackHoleStorage;
  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;
  use Funivan\CabbageFramework\Http\Request\Cookie\RequestCookiesInterface;

  class FileBasedAuthComponent implements AuthComponentInterface {

    /**
     * @var RequestCookiesInterface
     */
    private $cookies;

    /**
     * @var FileStorageInterface
     */
    private $authorizedUserStorage;

    /**
     * @var UsersInterface
     */
    private $users;

    /**
     * @var FileInterface|null
     */
    private $file;


    /**
     * @param RequestCookiesInterface $cookies
     * @param FileStorageInterface $authorizedUserStorage
     * @param UsersInterface $users
     */
    public function __construct(RequestCookiesInterface $cookies, FileStorageInterface $authorizedUserStorage, UsersInterface $users) {
      $this->cookies = $cookies;
      $this->authorizedUserStorage = $authorizedUserStorage;
      $this->users = $users;
    }


    /**
     * @return bool
     */
    final public function authenticated(): bool {
      return $this->file()->exists();
    }


    /**
     * @return UserInterface
     */
    final public function user(): \Funivan\CabbageFramework\Auth\UserInterface {
      if (!$this->authenticated()) {
        throw new \RuntimeException('User is not authenticated');
      }
      $uid = $this->file()->read();
      if (!$this->users->has($uid)) {
        throw new \RuntimeException(
          sprintf('User identity is corrupted. Can not identify user: %s', $uid)
        );
      }
      return $this->users->get($uid);
    }


    /**
     * Logout current authenticated user
     *
     * @return void
     */
    final public function logOut(): void {
      $file = $this->file();
      if ($file->exists()) {
        $file->remove();
      }
    }


    /**
     * @param UserInterface $user
     * @return void
     */
    final public function logIn(UserInterface $user): void {
      $this->file()->write($user->uid());
    }


    private function file(): FileInterface {
      if ($this->file === null) {
        if ($this->cookies->has(UserUidDispatcher::COOKIE_UID_NAME)) {
          $userUid = $this->cookies->get(UserUidDispatcher::COOKIE_UID_NAME)->value();
          $this->file = File::create(new LocalPath($userUid . '.txt'), $this->authorizedUserStorage);
        } else {
          $this->file = File::create(new LocalPath('/memory.txt'), new BlackHoleStorage());
        }
      }
      return $this->file;
    }
  }