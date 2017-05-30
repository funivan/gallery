<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\FileStorage\Fs\Local;

  use Funivan\Gallery\FileStorage\Exception\ReadException;
  use Funivan\Gallery\FileStorage\Exception\WriteException;
  use Funivan\Gallery\FileStorage\FileStorageInterface;
  use Funivan\Gallery\FileStorage\FinderFilterInterface;
  use Funivan\Gallery\FileStorage\PathInterface;
  use Symfony\Component\Finder\Finder;

  /**
   * Can be tested via integration tests.
   * Depend on local FS
   */
  class LocalFsStorage implements FileStorageInterface {

    const ALLOW_DIRECTORY_CREATION = 1;

    /**
     * @var int
     */
    private $option;

    /**
     * @var PathInterface
     */
    private $basePath;


    /**
     * @param PathInterface $basePath
     * @param int $options
     */
    public function __construct(PathInterface $basePath, int $options = 0) {
      $this->basePath = $basePath;
      $this->option = $options;
    }


    /**
     * @param PathInterface $path
     * @param string $data
     * @return void
     * @throws WriteException
     */
    public final function write(PathInterface $path, string $data) {
      $filePath = $this->basePath->next($path);
      $directory = $filePath->previous()->assemble();
      $validDir = true;
      if (self::ALLOW_DIRECTORY_CREATION === $this->option and !is_dir($directory)) {
        $validDir = @mkdir($directory, 0777, true);
      }
      if (!$validDir or !is_dir($directory)) {
        throw new WriteException(
          sprintf('Can not create file. Directory does not exists %s', $directory)
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
    public final function read(PathInterface $path): string {
      $result = file_get_contents($this->basePath->next($path)->assemble());
      if (false === $result) {
        throw new ReadException(sprintf('Can not read file :%s', $path->assemble()));
      }
      return (string) $result;
    }


    /**
     * @param PathInterface $path
     * @return bool
     */
    public final function file(PathInterface $path): bool {
      return is_file($this->basePath->next($path)->assemble());
    }


    /**
     * @param PathInterface $path
     * @return bool
     */
    public final function directory(PathInterface $path): bool {
      return is_dir($this->basePath->next($path)->assemble());
    }


    /**
     * @param PathInterface $path
     * @param string $name
     * @return string
     */
    public final function meta(PathInterface $path, string $name): string {
      $fullPath = $this->basePath->next($path)->assemble();
      if ('extension' === $name) {
        return pathinfo($fullPath, PATHINFO_EXTENSION);
      }
      throw new \InvalidArgumentException('Unsupported meta key');
    }


    /**
     * @param FinderFilterInterface $filters
     * @return array|PathInterface[]
     */
    public final function find(FinderFilterInterface $filters): array {
      $finder = new Finder();
      $searchPath = $this->basePath;
      $subPath = $filters->getPath();
      if (!$subPath->isRoot()) {
        $searchPath = $searchPath->next($subPath);
      }
      $finder->in($searchPath->assemble())
        ->depth(0);
      $finder->sortByName();

      $ext = $filters->getExtensions();
      if (count($ext) > 0) {
        $finder->name('/.+\.(' . implode('|', $ext) . ')$/i');
      }
      if ($filters->getType() === FinderFilterInterface::TYPE_FILE) {
        $finder->files();
      } elseif ($filters->getType() === FinderFilterInterface::TYPE_DIR) {
        $finder->directories();
      } else {
        throw new \InvalidArgumentException('Invalid filters parameters');
      }
      /** @var \Symfony\Component\Finder\SplFileInfo[] $files */
      $path = [];
      foreach ($finder as $file) {
        $path[] = $subPath->next(new LocalPath($file->getRelativePathname()));
      }
      $path = array_reverse($path);
      return $path;
    }


    /**
     * @param PathInterface $path
     * @throws WriteException
     */
    public final function remove(PathInterface $path) {
      $fullPath = $this->basePath->next($path)->assemble();
      if ($this->directory($path)) {
        $result = rmdir($fullPath);
      } else {
        $result = unlink($fullPath);
      }
      if (!$result) {
        throw new WriteException(
          sprintf('Can not remove %s', $path->assemble())
        );
      }
    }


    public function move(PathInterface $old, PathInterface $new): void {
      rename($old->assemble(), $new->assemble());
    }

  }