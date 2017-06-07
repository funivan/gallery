<?php

  namespace Funivan\Gallery\App\Image\Painter;

  use Funivan\Gallery\App\Image\Painter\Tool\PainterToolInterface;
  use Funivan\Gallery\FileStorage\File\FileInterface;
  use Intervention\Image\ImageManager;

  /**
   *
   */
  class Painter implements PainterInterface {

    /**
     * @var FileInterface
     */
    private $destinationFile;

    /**
     * @var ImageManager
     */
    private $imageManager;


    /**
     * @param ImageManager $imageManager
     * @param FileInterface $destinationFile
     */
    public function __construct(ImageManager $imageManager, FileInterface $destinationFile) {
      $this->destinationFile = $destinationFile;
      $this->imageManager = $imageManager;
    }


    /**
     * @param PainterToolInterface $painter
     * @return void
     */
    public function paint(PainterToolInterface $painter): void {
      $result = $painter->paint($this->imageManager);
      $this->destinationFile->write((string) $result->encode($this->destinationFile->meta('extension')));
    }
  }
