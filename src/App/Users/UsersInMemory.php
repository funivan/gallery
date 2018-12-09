<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Users;

  use Funivan\CabbageFramework\Auth\UserInterface;

  /**
   *
   */
  class UsersInMemory implements UsersInterface {

    /**
     * @var \Funivan\CabbageFramework\Auth\UserInterface[]
     */
    private $users;


    /**
     * @param UserInterface[] $users
     */
    public function __construct(array $users) {
      $this->users = $users;
    }


    /**
     * @param string $uid
     * @return bool
     */
    final public function has(string $uid): bool {
      $result = false;
      foreach ($this->users as $user) {
        if ($user->uid() === $uid) {
          $result = true;
          break;
        }
      }
      return $result;
    }


    /**
     * @param string $uid
     * @return \Funivan\CabbageFramework\Auth\UserInterface
     */
    final public function get(string $uid): UserInterface {
      foreach ($this->users as $user) {
        if ($user->uid() === $uid) {
          return $user;
        }
      }
      throw new \InvalidArgumentException('User does not exists');
    }

  }