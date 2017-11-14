<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Pages\Auth\LoginPage\Form;


  /**
   * @todo take a look: Data transfer object
   */
  interface ValidationResultInterface {

    /**
     * @return bool
     */
    public function valid(): bool;


    /**
     * @return string[]
     */
    public function errors(): array;
  }