<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\FileStorage;

  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;

  /**
   * @todo take a look: Data transfer object
   */
  class FinderFilter implements FinderFilterInterface {

    /**
     * @var array
     */
    private $extensions;

    /**
     * @var LocalPath
     */
    private $path;

    /**
     * @var int
     */
    private $type;


    /**
     * @param array $extensions
     * @param LocalPath $path
     * @param int $type
     */
    public function __construct(LocalPath $path, int $type, array $extensions = []) {
      $this->extensions = $extensions;
      $this->path = $path;
      $this->type = $type;
    }


    /**
     * @return array
     */
    public final function getExtensions(): array {
      return $this->extensions;
    }


    /**
     * @return int
     */
    public final function getType(): int {
      return $this->type;
    }


    /**
     * @return PathInterface
     */
    public final function getPath(): PathInterface {
      return $this->path;
    }

  }