<?php

  namespace Funivan\Gallery\App\Image\Painter;

  use Funivan\Gallery\FileStorage\File\FileInterface;

  interface PainterInterface {

    public function paint(FileInterface $file): FileInterface;

  }
