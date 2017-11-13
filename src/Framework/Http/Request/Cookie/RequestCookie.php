<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Http\Request\Cookie;

  /**
   * @todo take a look: Data transfer object
   */
  class RequestCookie implements RequestCookieInterface {

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $value;


    /**
     * @param string $name
     * @param string $value
     */
    public function __construct(string $name, string $value) {
      $this->name = $name;
      $this->value = $value;
    }


    /**
     * @return string
     */
    final public function name(): string {
      return $this->name;
    }


    /**
     * @return string
     */
    final public function value(): string {
      return $this->value;
    }


  }