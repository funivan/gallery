<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\FileStorage\Fs\Local;

  use Funivan\Gallery\FileStorage\Exception\ReadException;
  use Funivan\Gallery\FileStorage\Exception\WriteException;
  use Funivan\Gallery\FileStorage\FileStorageInterface;
  use Funivan\Gallery\FileStorage\Finder\FinderInterface;
  use Funivan\Gallery\FileStorage\Fs\Local\FsIterator\LocalFsFinder;
  use Funivan\Gallery\FileStorage\Fs\Local\Operation\DirectoryCheck;
  use Funivan\Gallery\FileStorage\Fs\Local\Operation\DirectoryOperation;
  use Funivan\Gallery\FileStorage\PathInterface;

  /**
   * Can be tested via integration tests.
   * Depend on local FS
   */
  class LocalFsStorage implements FileStorageInterface {

    /**
     * @var PathInterface
     */
    private $basePath;

    /**
     * @var DirectoryOperation
     */
    private $directoryCheck;


    /**
     * @param PathInterface $basePath
     * @param DirectoryOperation $directoryCheck
     */
    private function __construct(PathInterface $basePath, DirectoryOperation $directoryCheck) {
      $this->basePath = $basePath;
      $this->directoryCheck = $directoryCheck;
    }


    /**
     * @param PathInterface $basePath
     * @return FileStorageInterface
     */
    public static function create(PathInterface $basePath): FileStorageInterface {
      return new self($basePath, new DirectoryCheck());
    }


    /**
     * @param PathInterface $basePath
     * @param DirectoryOperation $directoryCheck
     * @return FileStorageInterface
     */
    public static function createWithDirectoryCheck(PathInterface $basePath, DirectoryOperation $directoryCheck): FileStorageInterface {
      return new self($basePath, $directoryCheck);
    }


    /**
     * @param PathInterface $path
     * @param string $data
     * @return void
     * @throws WriteException
     */
    final public function write(PathInterface $path, string $data): void {
      $filePath = $this->basePath->next($path);
      if (!$this->directoryCheck->perform($filePath->previous())) {
        throw new WriteException(
          sprintf('Can not create file. Directory does not exists %s', $path->previous()->assemble())
        );
      }
      $result = file_put_contents($filePath->assemble(), $data);
      if (false === $result) {
        throw new WriteException(
          sprintf('Can not create file: %s', $filePath->assemble())
        );
      }
    }


    /**
     * @param PathInterface $path
     * @return string
     * @throws ReadException
     */
    final public function read(PathInterface $path): string {
      $result = file_get_contents($this->basePath->next($path)->assemble());
      if (false === $result) {
        throw new ReadException(
          sprintf('Can not read file :%s', $path->assemble())
        );
      }
      return (string) $result;
    }


    /**
     * @param PathInterface $path
     * @param string $name
     * @return string
     */
    final public function meta(PathInterface $path, string $name): string {
      if ('extension' === $name) {
        return pathinfo($path->assemble(), PATHINFO_EXTENSION);
      }
      throw new \InvalidArgumentException('Unsupported meta key');
    }


    /**
     * @param PathInterface $path
     * @return string
     */
    final public function type(PathInterface $path): string {
      $fullPath = $this->basePath->next($path)->assemble();
      $result = FileStorageInterface::TYPE_UNKNOWN;
      if (is_file($fullPath)) {
        $result = FileStorageInterface::TYPE_FILE;
      } elseif (is_dir($fullPath)) {
        $result = FileStorageInterface::TYPE_DIRECTORY;
      }
      return $result;
    }


    /**
     * @param PathInterface $path
     * @return FinderInterface
     */
    final public function finder(PathInterface $path): FinderInterface {
      return new LocalFsFinder($this->basePath, $path);
    }


    /**
     * @param PathInterface $path
     * @throws WriteException
     */
    final public function remove(PathInterface $path): void {
      $fullPath = $this->basePath->next($path)->assemble();
      $result = unlink($fullPath);
      if (!$result) {
        throw new WriteException(
          sprintf('Can not remove %s', $path->assemble())
        );
      }
    }


    /**
     * @param PathInterface $old
     * @param PathInterface $new
     * @throws WriteException
     */
    final public function move(PathInterface $old, PathInterface $new): void {
      $result = rename(
        $this->basePath->next($old)->assemble(),
        $this->basePath->next($new)->assemble()
      );
      if (!$result) {
        throw new WriteException(
          sprintf('Can not rename file from %s to %s', $old->assemble(), $new->assemble())
        );
      }
    }

  }