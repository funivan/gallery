<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Http\Request\Cookie;

  /**
   *
   */
  interface RequestCookieInterface {

    /**
     * @return string
     */
    public function name(): string;


    /**
     * @return string
     */
    public function value(): string;


  }