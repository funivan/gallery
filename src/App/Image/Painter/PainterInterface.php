<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Image\Painter;

  use Funivan\Gallery\App\Image\Painter\Tool\PainterToolInterface;


  /**
   *
   */
  interface PainterInterface {

    /**
     * @param PainterToolInterface $painter
     */
    public function paint(PainterToolInterface $painter): void;

  }