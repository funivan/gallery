<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Image;

  use Funivan\CabbageFs\PathInterface;


  /**
   *
   */
  interface LocationInterface {

    /**
     * @return PathInterface
     */
    public function path(): PathInterface;

  }