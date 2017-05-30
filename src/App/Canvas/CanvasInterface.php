<?php

  namespace Funivan\Gallery\App\Canvas;

  use Funivan\Gallery\App\Canvas\Painter\PainterInterface;
  use Funivan\Gallery\FileStorage\File\FileInterface;


  /**
   *
   */
  interface CanvasInterface {

    /**
     * @param PainterInterface $painter
     */
    public function paint(PainterInterface $painter): void;


    /**
     * @return FileInterface
     */
    public function file(): FileInterface;

  }