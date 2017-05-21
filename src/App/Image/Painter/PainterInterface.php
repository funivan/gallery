<?php

  namespace Funivan\Gallery\App\Image\Painter;

  use Funivan\Gallery\FileStorage\File\FileInterface;

  /**
   *
   */
  interface PainterInterface {

    /**
     * @param FileInterface $source
     * @param FileInterface $destination
     * @return void
     */
    public function paint(FileInterface $source, FileInterface $destination);

  }
