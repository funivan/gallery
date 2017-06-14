<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Auth;

  use Funivan\Gallery\App\Users\UsersInterface;
  use Funivan\Gallery\FileStorage\File\File;
  use Funivan\Gallery\FileStorage\File\FileInterface;
  use Funivan\Gallery\FileStorage\FileStorageInterface;
  use Funivan\Gallery\FileStorage\Fs\BlackHole\BlackHoleStorage;
  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;
  use Funivan\Gallery\Framework\Auth\AuthComponentInterface;
  use Funivan\Gallery\Framework\Auth\UserInterface;
  use Funivan\Gallery\Framework\Http\Request\Cookie\RequestCookiesInterface;

  /**
   *
   */
  class AuthComponent implements AuthComponentInterface {

    /**
     * @var UsersInterface
     */
    private $users;

    /**
     * @var FileInterface
     */
    private $file;


    /**
     * @param FileInterface $file
     * @param UsersInterface $users
     */
    private function __construct(FileInterface $file, UsersInterface $users) {
      $this->file = $file;
      $this->users = $users;
    }


    /**
     * @todo take a look: Not code free constructor
     * We use files to store authorized user UID in the system
     *
     * @param RequestCookiesInterface $cookies
     * @param FileStorageInterface $authorizedUserStorage
     * @param UsersInterface $users
     * @return AuthComponentInterface
     */
    public static function createFromCookie(RequestCookiesInterface $cookies, FileStorageInterface $authorizedUserStorage, UsersInterface $users): AuthComponentInterface {
      if ($cookies->has(UserUidDispatcher::COOKIE_UID_NAME)) {
        $userUid = $cookies->get(UserUidDispatcher::COOKIE_UID_NAME)->value();
        $file = File::create(new LocalPath($userUid . '.txt'), $authorizedUserStorage);
      } else {
        $file = File::create(new LocalPath('/memory.txt'), new BlackHoleStorage());
      }
      return new self($file, $users);
    }


    /**
     * @param FileInterface $file
     * @param UsersInterface $users
     * @return AuthComponentInterface
     */
    public static function create(FileInterface $file, UsersInterface $users): AuthComponentInterface {
      return new self($file, $users);
    }


    /**
     * @return bool
     */
    public final function authenticated(): bool {
      return $this->file->exists();
    }


    /**
     * @return UserInterface
     */
    public final function user(): UserInterface {
      if (!$this->authenticated()) {
        throw new \RuntimeException('User is not authenticated');
      }
      $uid = $this->file->read();
      if (!$this->users->has($uid)) {
        throw new \RuntimeException(
          sprintf('User identity is corrupted. Can not identify user: %s', $uid)
        );
      }
      return $this->users->get($uid);
    }


    /**
     * @return void
     */
    public final function logOut(): void {
      if ($this->file->exists()) {
        $this->file->remove();
      }
    }


    /**
     * @param UserInterface $user
     * @return void
     */
    public final function logIn(UserInterface $user): void {
      $this->file->write($user->uid());
    }

  }