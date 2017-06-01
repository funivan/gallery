<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\FileStorage\Fs\Memory;

  use Funivan\Gallery\FileStorage\Exception\ReadException;
  use Funivan\Gallery\FileStorage\FileStorageInterface;
  use Funivan\Gallery\FileStorage\FinderFilterInterface;
  use Funivan\Gallery\FileStorage\PathInterface;

  /**
   * Does not support directory operations
   */
  class MemoryStorage implements FileStorageInterface {

    /**
     * Store plain content in the memory
     *
     * @var array Array<String, String>
     */
    private $files;


    /**
     * @param PathInterface $path
     * @return bool
     */
    public final function file(PathInterface $path): bool {
      return array_key_exists($path->assemble(), $this->files);
    }


    /**
     * @param PathInterface $path
     * @return bool
     */
    public final function directory(PathInterface $path): bool {
      throw new \BadMethodCallException('Directories are not supported by this adapter');
    }


    /**
     * @param FinderFilterInterface $finder
     * @return PathInterface[]
     */
    public final function find(FinderFilterInterface $finder): array {
      throw new \BadMethodCallException('"Find" operation is not supported by this adapter');
    }


    /**
     * @param PathInterface $path
     * @param string $name
     * @return string
     */
    public final function meta(PathInterface $path, string $name): string {
      if ('extension' === $name) {
        return pathinfo($path->name(), PATHINFO_EXTENSION);
      }
      throw new \InvalidArgumentException('Unsupported meta key');
    }


    /**
     * @param PathInterface $path
     * @param string $data
     */
    public final function write(PathInterface $path, string $data) {
      $filePath = $path->assemble();
      $this->files[$filePath] = $data;
    }


    /**
     * @param PathInterface $path
     * @return string
     * @throws ReadException
     */
    public final function read(PathInterface $path): string {
      $filePath = $path->assemble();
      if (!array_key_exists($filePath, $this->files)) {
        throw new ReadException(sprintf('Can not read file contents : %s', $filePath));
      }
      return (string) $this->files[$filePath];
    }


    /**
     * @param PathInterface $path
     */
    public final function remove(PathInterface $path) {
      unset($this->files[$path->assemble()]);
    }


    /**
     * @param PathInterface $old
     * @param PathInterface $new
     */
    public function move(PathInterface $old, PathInterface $new): void {
      $this->write($new, $this->read($old));
      $this->remove($old);
    }


  }