<?php

  namespace Funivan\Gallery\App\Image;

  use Funivan\Gallery\App\Image\Painter\PainterInterface;
  use Funivan\Gallery\FileStorage\File\FileInterface;


  /**
   *
   */
  interface ImageInterface {

    /**
     * @param PainterInterface $painter
     * @return void
     */
    public function paint(PainterInterface $painter);


    /**
     * @return FileInterface
     */
    public function original(): FileInterface;

  }