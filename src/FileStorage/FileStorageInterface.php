<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\FileStorage;

  /**
   */
  interface FileStorageInterface {

    const TYPE_UNKNOWN = 'unknown';

    const TYPE_FILE = 'file';

    const TYPE_DIRECTORY = 'directory';


    /**
     * @param FinderFilterInterface $finder
     * @return PathInterface[]
     */
    public function find(FinderFilterInterface $finder): array;


    /**
     * @param PathInterface $path
     * @param string $name
     * @return string
     */
    public function meta(PathInterface $path, string $name): string;


    /**
     * @param PathInterface $path
     * @param string $data
     */
    public function write(PathInterface $path, string $data): void;


    /**
     * @param PathInterface $path
     * @return string
     */
    public function read(PathInterface $path): string;


    /**
     * @param PathInterface $path
     */
    public function remove(PathInterface $path): void;


    /**
     * @param PathInterface $old
     * @param PathInterface $new
     */
    public function move(PathInterface $old, PathInterface $new): void;

  }