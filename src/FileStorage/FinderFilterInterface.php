<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\FileStorage;

  /**
   *
   */
  interface FinderFilterInterface {

    const TYPE_FILE = 1;

    const TYPE_DIR = 2;


    /**
     * @return string[]
     */
    public function getExtensions(): array;


    /**
     * 1 - search for files
     * 2 - search for directories
     * @return int
     */
    public function getType(): int;


    /**
     * @return PathInterface
     */
    public function getPath(): PathInterface;

  }