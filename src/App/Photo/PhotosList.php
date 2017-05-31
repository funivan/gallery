<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Photo;


  use Funivan\Gallery\App\Canvas\Canvas;
  use Funivan\Gallery\App\Canvas\CanvasInterface;
  use Funivan\Gallery\FileStorage\FileStorageInterface;

  /**
   *
   */
  class PhotosList implements \IteratorAggregate {

    /**
     * @var CanvasInterface[]
     */
    private $photos;


    /**
     * @param CanvasInterface[] $photos
     */
    private function __construct(array $photos) {
      $this->photos = $photos;
    }


    /**
     * @param array $paths
     * @param FileStorageInterface $fs
     * @return PhotosList
     */
    public static function createFromPathList(array $paths, FileStorageInterface $fs): PhotosList {
      $photos = [];
      foreach ($paths as $path) {
        $photos[] = Canvas::createFromRawPath($path, $fs);
      }
      return new self($photos);
    }


    /**
     * @return CanvasInterface[]
     */
    public function getIterator() {
      return new \ArrayIterator($this->photos);
    }

  }