<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\Framework\Router;

  /**
   * @todo maybe we should rename this class to the "UrlBuildInterface"
   */
  interface RouteBuildInterface {

    /**
     * Create url from the parameters
     *
     * @return string
     */
    public function build(): string;

  }