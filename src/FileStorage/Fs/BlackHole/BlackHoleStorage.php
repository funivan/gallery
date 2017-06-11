<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\FileStorage\Fs\BlackHole;

  use Funivan\Gallery\FileStorage\FileStorageInterface;
  use Funivan\Gallery\FileStorage\FinderFilterInterface;
  use Funivan\Gallery\FileStorage\PathInterface;

  /**
   *
   */
  class BlackHoleStorage implements FileStorageInterface {

    /**
     * @param FinderFilterInterface $finder
     * @return PathInterface[]
     */
    public final function find(FinderFilterInterface $finder): array {
      return [];
    }


    /**
     * @param PathInterface $path
     * @param string $name
     * @return string
     */
    public final function meta(PathInterface $path, string $name): string {
      throw new \BadMethodCallException('"Meta" operation is not supported by this adapter');
    }


    /**
     * @param PathInterface $path
     * @return string
     */
    public function type(PathInterface $path): string {
      return FileStorageInterface::TYPE_UNKNOWN;
    }


    /**
     * @param PathInterface $path
     * @param string $data
     * @return void
     */
    public final function write(PathInterface $path, string $data): void {

    }


    /**
     * @param PathInterface $path
     * @return string
     */
    public final function read(PathInterface $path): string {
      throw new \BadMethodCallException('"Read" operation is not supported by this adapter');
    }


    /**
     * @param PathInterface $path
     */
    public final function remove(PathInterface $path): void {

    }


    /**
     * @param PathInterface $old
     * @param PathInterface $new
     */
    public function move(PathInterface $old, PathInterface $new): void {

    }


  }