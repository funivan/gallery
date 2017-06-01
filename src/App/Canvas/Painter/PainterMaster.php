<?php

  namespace Funivan\Gallery\App\Canvas\Painter;

  use Funivan\Gallery\FileStorage\File\FileInterface;

  /**
   *
   */
  class PainterMaster {

    /**
     * @var FileInterface
     */
    private $file;


    /**
     * @param FileInterface $file
     */
    public function __construct(FileInterface $file) {
      $this->file = $file;
    }


    /**
     * @param PainterInterface $painter
     */
    public function paint(PainterInterface $painter): void {
      $result = $painter->paint();
      $this->file->write((string) $result->encode($this->file->meta('extension')));
    }
  }
