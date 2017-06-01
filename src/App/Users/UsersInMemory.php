<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Users;

  use Funivan\Gallery\Framework\Auth\UserInterface;

  /**
   *
   */
  class UsersInMemory implements UsersInterface {

    /**
     * @var UserInterface[]
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
    public function has(string $uid): bool {
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
     * @return UserInterface
     */
    public function get(string $uid): UserInterface {
      foreach ($this->users as $user) {
        if ($user->uid() === $uid) {
          return $user;
        }
      }
      throw new \InvalidArgumentException('User does not exists');
    }

  }