<?php

  namespace Funivan\Gallery\App\Image\Painter\Tool;

  /**
   *
   */
  interface PainterToolInterface {

    /**
     * @return \Intervention\Image\Image
     */
    public function paint(): \Intervention\Image\Image;

  }
