<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Users;

  use Funivan\CabbageFramework\Auth\UserInterface;


  /**
   *
   */
  interface UsersInterface {

    /**
     * @param string $uid
     * @return bool
     */
    public function has(string $uid): bool;


    /**
     * @param string $uid
     * @return UserInterface
     */
    public function get(string $uid): UserInterface;
  }