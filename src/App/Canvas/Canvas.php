<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Canvas;

  use Funivan\Gallery\FileStorage\File\File;
  use Funivan\Gallery\FileStorage\File\FileInterface;
  use Funivan\Gallery\FileStorage\FileStorageInterface;
  use Funivan\Gallery\FileStorage\PathInterface;

  /**
   * Represent image in the system.
   *
   */
  class Canvas implements CanvasInterface {

    /**
     * @var FileInterface
     */
    private $file;


    /**
     * @param FileInterface $file
     */
    private function __construct(FileInterface $file) {
      $this->file = $file;
    }


    /**
     * @param PathInterface $path
     * @param FileStorageInterface $fs
     * @return CanvasInterface
     */
    public static function createFromRawPath(PathInterface $path, FileStorageInterface $fs): CanvasInterface {
      return new self(File::create($path, $fs));
    }


    /**
     * @return FileInterface
     */
    public function file(): FileInterface {
      return $this->file;
    }


  }