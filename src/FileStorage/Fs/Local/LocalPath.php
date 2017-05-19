<?php

  namespace Funivan\Gallery\FileStorage\Fs\Local;

  use Funivan\Gallery\FileStorage\PathInterface;

  /**
   * Represent path to the file or directory in the file system
   */
  class LocalPath implements PathInterface {

    /**
     * @var string
     */
    private $path;


    /**
     * @param string $path
     */
    public function __construct(string $path) {
      $this->path = $path;
    }


    /**
     * @param PathInterface $path
     * @return PathInterface
     */
    public final function next(PathInterface $path): PathInterface {
      if ($path->isRoot()) {
        throw new \InvalidArgumentException('Next path can not be root');
      }
      return new self(
        rtrim($this->assemble(), '/')
        . '/' .
        ltrim($path->assemble(), '/')
      );
    }


    /**
     * @return bool
     */
    public final function isRoot(): bool {
      return '/' === $this->path;
    }


    /**
     * @return PathInterface
     */
    public final function previous(): PathInterface {
      if ($this->isRoot()) {
        throw new \RuntimeException('Can not retrieve previous path. LocalPath is root already');
      }
      $currentPath = $this->assemble();
      $dirs = preg_split('!(/)!', $currentPath, -1, PREG_SPLIT_DELIM_CAPTURE);
      $result = implode('', array_slice($dirs, 0, -2));
      if ('' === $result and '' !== $currentPath) {
        $result = '/';
      }
      return new LocalPath($result);
    }


    /**
     * @return string
     */
    public final function name(): string {
      if ($this->isRoot()) {
        $name = '/';
      } else {
        $items = explode('/', $this->assemble());
        $name = (string) end($items);
      }
      return $name;
    }


    /**
     * @param PathInterface $path
     * @return bool
     */
    public final function equal(PathInterface $path): bool {
      return $path->assemble() === $this->assemble();
    }


    /**
     * @return string
     */
    public final function assemble(): string {
      if (!$this->isRoot() and preg_match('!/$!', $this->path) === 1) {
        throw new \InvalidArgumentException('Path is invalid. Should not be ended with: /');
      }
      return $this->path;
    }

  }
