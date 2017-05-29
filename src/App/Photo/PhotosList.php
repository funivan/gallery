<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Photo;


  use Funivan\Gallery\App\Canvas\Canvas;
  use Funivan\Gallery\FileStorage\FileStorageInterface;

  /**
   *
   */
  class PhotosList implements \IteratorAggregate {

    /**
     * @var array|PhotoInterface[]
     */
    private $photos;


    /**
     * @param PhotoInterface[] $photos
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
        $photos[] = new Photo(Canvas::createFromRawPath($path, $fs));
      }
      return new self($photos);
    }


    /**
     * @return \ArrayIterator|PhotoInterface[]
     */
    public function getIterator(): \ArrayIterator {
      return new \ArrayIterator($this->photos);
    }

  }