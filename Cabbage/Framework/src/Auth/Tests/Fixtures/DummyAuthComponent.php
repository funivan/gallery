<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Auth\Tests\Fixtures;

  use Funivan\CabbageFramework\Auth\AuthComponentInterface;
  use Funivan\CabbageFramework\Auth\UserInterface;

  /**
   * @codeCoverageIgnore
   */
  class DummyAuthComponent implements AuthComponentInterface {

    /**
     * @var UserInterface
     */
    private $user;

    /**
     * @var \Funivan\CabbageFramework\Auth\UserInterface
     */
    private $anonymous;


    /**
     * @param \Funivan\CabbageFramework\Auth\UserInterface $user
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
     * @return \Funivan\CabbageFramework\Auth\UserInterface
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
     * @param \Funivan\CabbageFramework\Auth\UserInterface $user
     * @return void
     */
    public function logIn(UserInterface $user): void {
      $this->user = $user;
    }

  }