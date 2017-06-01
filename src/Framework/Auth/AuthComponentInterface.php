<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\Framework\Auth;

  /**
   *
   */
  interface AuthComponentInterface {

    /**
     * @return bool
     */
    public function authenticated(): bool;


    /**
     * Retrieve authenticated user
     *
     * @return UserInterface
     */
    public function user(): UserInterface;


    /**
     * Logout current authenticated user
     *
     * @return void
     */
    public function logOut(): void;


    /**
     * Login specific user
     *
     * @param UserInterface $user
     * @return void
     */
    public function logIn(UserInterface $user): void;


  }