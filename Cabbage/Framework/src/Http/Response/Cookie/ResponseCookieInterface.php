<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Http\Response\Cookie;

  /**
   *
   */
  interface ResponseCookieInterface {


    /**
     * @return string
     */
    public function assemble(): string;

  }