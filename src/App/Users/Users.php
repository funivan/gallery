<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Users;

  use Funivan\CabbageFramework\Auth\UserInterface;
  use Funivan\CabbageFs\File\FileInterface;

  /**
   *
   */
  class Users implements UsersInterface {

    /**
     * @var FileInterface
     */
    private $file;


    /**
     * @param FileInterface $file
     */
    public function __construct(FileInterface $file) {
      $this->file = $file;
    }


    /**
     * @param string $uid
     * @return bool
     */
    final public function has(string $uid): bool {
      $rawUsers = json_decode($this->file->read(), true);
      return array_key_exists($uid, $rawUsers['users']);
    }


    /**
     * @param string $uid
     * @return \Funivan\CabbageFramework\Auth\UserInterface
     */
    final public function get(string $uid): UserInterface {
      $rawUsers = json_decode($this->file->read(), true);
      if (!array_key_exists($uid, $rawUsers['users'])) {
        throw new \InvalidArgumentException(sprintf('User does not exists :%s', $uid));
      }
      $rawUserData = $rawUsers['users'][$uid];
      return new User(
        $uid,
        (string) $rawUserData['pass'],
        (array) $rawUserData['rules']
      );
    }

  }