<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\Framework\Templating;


  /**
   * Plain view interface
   */
  interface ViewInterface {

    /**
     * @return string
     */
    public function render(): string;

  }