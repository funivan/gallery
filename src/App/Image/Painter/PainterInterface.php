<?php

  namespace Funivan\Gallery\App\Image\Painter;

  /**
   *
   */
  interface PainterInterface {

    /**
     * @return \Intervention\Image\Image
     */
    public function paint(): \Intervention\Image\Image;

  }
