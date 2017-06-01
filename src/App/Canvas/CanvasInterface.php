<?php

  namespace Funivan\Gallery\App\Canvas;

  use Funivan\Gallery\FileStorage\File\FileInterface;


  /**
   *
   */
  interface CanvasInterface {


    /**
     * @return FileInterface
     */
    public function file(): FileInterface;

  }