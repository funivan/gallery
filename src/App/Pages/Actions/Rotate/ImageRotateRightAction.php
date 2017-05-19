<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Pages\Actions\Rotate;

  use Funivan\Gallery\App\Image\Painter\RotatePainter;
  use Funivan\Gallery\App\Pages\Actions\ImageActionInterface;
  use Funivan\Gallery\FileStorage\File\FileInterface;

  class ImageRotateRightAction implements ImageActionInterface {


    /**
     * @param FileInterface $image
     * @return void
     */
    public function execute(FileInterface $image) {
      (new RotatePainter(90))->paint($image);
    }

  }
