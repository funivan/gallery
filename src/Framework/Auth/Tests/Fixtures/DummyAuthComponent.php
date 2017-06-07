<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Auth\Tests\Fixtures;

  use Funivan\Gallery\Framework\Auth\AuthComponentInterface;
  use Funivan\Gallery\Framework\Auth\UserInterface;

  /**
   * @codeCoverageIgnore
   */
  class DummyAuthComponent implements AuthComponentInterface {

    /**
     * @var UserInterface
     */
    private $user;

    /**
     * @var UserInterface
     */
    private $anonymous;


    /**
     * @param UserInterface $user
     */
    public function __construct(UserInterface $user) {
      $this->user = $user;
      $this->anonymous = new DummyUser(DummyUser::ANONYMOUS);
    }


    /**
     * @return bool
     */
    public function authenticated(): bool {
      return $this->user()->uid() !== $this->anonymous->uid();
    }


    /**
     * Retrieve authenticated user
     *
     * @return UserInterface
     */
    public function user(): UserInterface {
      return $this->user;
    }


    /**
     * Logout current authenticated user
     *
     * @return void
     */
    public function logOut(): void {
      $this->user = $this->anonymous;
    }


    /**
     * Login specific user
     *
     * @param UserInterface $user
     * @return void
     */
    public function logIn(UserInterface $user): void {
      $this->user = $user;
    }

  }