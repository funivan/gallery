<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Http\Request\Cookie;

  /**
   *
   */
  interface RequestCookiesInterface {

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool;


    /**
     * @param string $name
     * @return RequestCookieInterface
     */
    public function get(string $name): RequestCookieInterface;


  }