<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFs\Fs\BlackHole;

  use Funivan\CabbageFs\FileStorageInterface;
  use Funivan\CabbageFs\Finder\EmptyFinder;
  use Funivan\CabbageFs\Finder\FinderInterface;
  use Funivan\CabbageFs\PathInterface;

  /**
   *
   */
  class BlackHoleStorage implements FileStorageInterface {


    /**
     * @param PathInterface $path
     * @return FinderInterface
     */
    final public function finder(PathInterface $path): FinderInterface {
      return new EmptyFinder();
    }


    /**
     * @param PathInterface $path
     * @param string $name
     * @return string
     */
    final public function meta(PathInterface $path, string $name): string {
      throw new \BadMethodCallException('"Meta" operation is not supported by this adapter');
    }


    /**
     * @param PathInterface $path
     * @return string
     */
    final public function type(PathInterface $path): string {
      return FileStorageInterface::TYPE_UNKNOWN;
    }


    /**
     * @param PathInterface $path
     * @param string $data
     * @return void
     */
    final public function write(PathInterface $path, string $data): void {

    }


    /**
     * @param PathInterface $path
     * @return string
     */
    final public function read(PathInterface $path): string {
      throw new \BadMethodCallException('"Read" operation is not supported by this adapter');
    }


    /**
     * @param PathInterface $path
     */
    final public function remove(PathInterface $path): void {

    }


    /**
     * @param PathInterface $old
     * @param PathInterface $new
     */
    final public function move(PathInterface $old, PathInterface $new): void {

    }


  }