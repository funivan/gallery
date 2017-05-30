<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Photo\Meta;

  /**
   *
   */
  interface MetaFlagInterface {


    /**
     * @return bool
     */
    public function enabled(): bool;

  }