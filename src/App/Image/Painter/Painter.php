<?php

  namespace Funivan\Gallery\App\Image\Painter;

  use Funivan\Gallery\App\Image\Painter\Tool\PainterToolInterface;
  use Funivan\Gallery\FileStorage\File\FileInterface;

  /**
   *
   */
  class Painter implements PainterInterface {

    /**
     * @var FileInterface
     */
    private $destinationFile;


    /**
     * @param FileInterface $destinationFile
     */
    public function __construct(FileInterface $destinationFile) {
      $this->destinationFile = $destinationFile;
    }


    /**
     * @param PainterToolInterface $painter
     * @return void
     */
    public function paint(PainterToolInterface $painter): void {
      $result = $painter->paint();
      $this->destinationFile->write((string) $result->encode($this->destinationFile->meta('extension')));
    }
  }
