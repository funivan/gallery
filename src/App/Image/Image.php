<?php

  namespace Funivan\Gallery\App\Image;

  use Funivan\Gallery\FileStorage\FileStorageInterface;
  use Funivan\Gallery\FileStorage\PathInterface;

  /**
   * Work with binary data so can not be immutable
   */
  class Image {

    /**
     * @var PathInterface
     */
    private $path;

    /**
     * @var FileStorageInterface
     */
    private $fileStorage;


    /**
     * @param PathInterface $path
     * @param FileStorageInterface $fileStorage
     */
    public function __construct(PathInterface $path, FileStorageInterface $fileStorage) {
      $this->path = $path;
      $this->fileStorage = $fileStorage;
    }


    /**
     * @return bool
     */
    public final function stored(): bool {
      return $this->fileStorage->file($this->path);
    }


    /**
     * @return string
     */
    public final function extension(): string {
      return $this->fileStorage->meta($this->path, 'extension');
    }


    /**
     * @param string $data
     */
    public final  function write(string $data) {
      $this->fileStorage->write($this->path, $data);
    }


    /**
     * @return PathInterface
     */
    public final function path(): PathInterface {
      return $this->path;
    }


    /**
     * @return string
     */
    public final function read(): string {
      return $this->fileStorage->read($this->path);
    }

  }
