<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Users;

  use Funivan\Gallery\FileStorage\File\FileInterface;

  /**
   *
   */
  class Users {

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
     * @param string $name
     * @return bool
     */
    public final function has(string $name): bool {
      $rawUsers = json_decode($this->file->read(), true);
      return array_key_exists($name, $rawUsers['users']);
    }


    /**
     * @param string $name
     * @return User
     */
    public final function get(string $name): User {
      $rawUsers = json_decode($this->file->read(), true);
      if (!array_key_exists($name, $rawUsers['users'])) {
        throw new \InvalidArgumentException(sprintf('User does not exists :%s', $name));
      }
      $rawUserData = $rawUsers['users'][$name];
      return new User(
        $name,
        (string) $rawUserData['pass'],
        (array) $rawUserData['rules']
      );
    }

  }