<?php

  namespace Funivan\Gallery\App\Canvas\Painter;

  /**
   *
   */
  interface PainterInterface {

    /**
     * @return \Intervention\Image\Image
     */
    public function paint(): \Intervention\Image\Image;

  }
