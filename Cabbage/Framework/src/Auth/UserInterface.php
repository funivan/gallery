<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Auth;

  /**
   * Represent user identity in the system
   */
  interface UserInterface {

    /**
     * Return unique user id
     *
     * @return string
     */
    public function uid(): string;


    /**
     * Check if user can perform some action according to the rules
     *
     * @param string $ruleId
     * @return bool
     */
    public function authorized(string $ruleId): bool;


    /**
     * @param string $password
     * @return bool
     */
    public function validatePassword(string $password): bool;

  }