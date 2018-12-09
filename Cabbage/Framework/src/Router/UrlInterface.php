<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Router;

  /**
   * Represent url to the resource.
   * Can be absolute and relative
   */
  interface UrlInterface {

    /**
     * @return string
     */
    public function build(): string;

  }