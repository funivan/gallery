<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Photo;

  /**
   *
   */
  interface StateInterface {


    /**
     * @return bool
     */
    public function enabled(): bool;

  }