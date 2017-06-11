<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\FileStorage\File;

  use Funivan\Gallery\FileStorage\FileStorageInterface;
  use Funivan\Gallery\FileStorage\Fs\BlackHole\BlackHoleStorage;
  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;
  use Funivan\Gallery\FileStorage\Fs\Memory\MemoryStorage;
  use Funivan\Gallery\FileStorage\PathInterface;

  /**
   *
   */
  class File implements FileInterface {

    /**
     * @var PathInterface
     */
    private $path;

    /**
     * @var FileStorageInterface
     */
    private $storage;


    /**
     * @param PathInterface $path
     * @param FileStorageInterface $storage
     */
    public function __construct(PathInterface $path, FileStorageInterface $storage) {
      $this->path = $path;
      $this->storage = $storage;
    }


    /**
     * @param string $content
     * @return FileInterface
     */
    public static function createInMemory(string $content = ''): FileInterface {
      $file = new self(new LocalPath('/memory.txt'), new MemoryStorage());
      $file->write($content);
      return $file;
    }


    /**
     * @return FileInterface
     */
    public static function createBlackHole(): FileInterface {
      return new self(new LocalPath('/memory.txt'), new BlackHoleStorage());
    }


    /**
     * @param PathInterface $path
     * @param FileStorageInterface $storage
     * @return mixed
     */
    public static function create(PathInterface $path, FileStorageInterface $storage): FileInterface {
      return new self($path, $storage);
    }


    /**
     * Return content of the file
     *
     * @return string
     */
    public final function read(): string {
      return $this->storage->read($this->path);
    }


    /**
     * @return bool
     */
    public final function exists(): bool {
      return FileStorageInterface::TYPE_FILE === $this->storage->type($this->path);
    }


    /**
     * @return void
     */
    public final function remove(): void {
      $this->storage->remove($this->path);
    }


    /**
     * Write content to the file
     *
     * @param string $content
     * @return void
     */
    public final function write(string $content): void {
      $this->storage->write($this->path, $content);
    }


    /**
     * @param string $type
     * @return string
     */
    public final function meta(string $type): string {
      return $this->storage->meta($this->path, $type);
    }


    /**
     * @return PathInterface
     */
    public function path(): PathInterface {
      return $this->path;
    }


    /**
     * @param PathInterface $path
     * @return FileInterface
     */
    public function move(PathInterface $path): FileInterface {
      $this->storage->move($this->path(), $path);
      return new self($path, $this->storage);
    }


  }