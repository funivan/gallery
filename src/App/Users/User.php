<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Users;

  use Funivan\Gallery\Framework\Auth\UserInterface;

  /**
   *
   */
  class User implements UserInterface {

    /**
     * @var string
     */
    private $uid;

    /**
     * @var string
     */
    private $pass;

    /**
     * Id of allowed rules
     *
     * @var string[]
     */
    private $rules;


    /**
     * @param string $uid
     * @param string $pass
     * @param array $rules
     */
    public function __construct(string $uid, string $pass, array $rules) {
      $this->uid = $uid;
      $this->pass = $pass;
      $this->rules = $rules;
    }


    /**
     * Return unique user id
     *
     * @return string
     */
    public final function uid(): string {
      return $this->uid;
    }


    /**
     * @param string $inputPass
     * @return bool
     */
    public final function validatePassword(string $inputPass): bool {
      return ($this->pass === $inputPass);
    }


    /**
     * Check if user can perform some action according to the rules
     *
     * @param string $ruleId
     * @return bool
     */
    public final function authorized(string $ruleId): bool {
      return in_array($ruleId, $this->rules, true);
    }

  }