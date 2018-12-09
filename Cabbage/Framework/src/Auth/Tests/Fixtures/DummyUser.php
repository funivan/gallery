<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Auth\Tests\Fixtures;

  use Funivan\CabbageFramework\Auth\UserInterface;

  /**
   * @codeCoverageIgnore
   */
  class DummyUser implements UserInterface {

    public const ANONYMOUS = 'anonymous';

    /**
     * @var string
     */
    private $uid;

    /**
     * @var string
     */
    private $pass;

    /**
     * @var array
     */
    private $rules;


    /**
     * @param string $uid
     * @param string $pass
     * @param array $rules
     */
    public function __construct(string $uid, string $pass = '', array $rules = []) {
      $this->uid = $uid;
      $this->pass = $pass;
      $this->rules = $rules;
    }


    /**
     * Return unique user id
     *
     * @return string
     */
    public function uid(): string {
      return $this->uid;
    }


    /**
     * Check if user can perform some action according to the rules
     *
     * @param string $ruleId
     * @return bool
     */
    public function authorized(string $ruleId): bool {
      return in_array($ruleId, $this->rules);
    }


    /**
     * @param string $password
     * @return bool
     */
    public function validatePassword(string $password): bool {
      return $password === $this->pass;
    }

  }