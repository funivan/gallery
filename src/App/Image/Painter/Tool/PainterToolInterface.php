<?php

  namespace Funivan\Gallery\App\Image\Painter\Tool;

  use Intervention\Image\Image;
  use Intervention\Image\ImageManager;

  /**
   *
   */
  interface PainterToolInterface {

    /**
     * @param ImageManager $imageManager
     * @return Image
     */
    public function paint(ImageManager $imageManager): Image;

  }
