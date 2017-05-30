<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\FileStorage;

  /**
   */
  interface FileStorageInterface {

    /**
     * @param PathInterface $path
     * @return bool
     */
    public function file(PathInterface $path): bool;


    /**
     * @param PathInterface $path
     * @return bool
     */
    public function directory(PathInterface $path): bool;


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
    public function write(PathInterface $path, string $data);


    /**
     * @param PathInterface $path
     * @return string
     */
    public function read(PathInterface $path): string;


    /**
     * @param PathInterface $path
     */
    public function remove(PathInterface $path);


    /**
     * @param PathInterface $old
     * @param PathInterface $new
     */
    public function move(PathInterface $old, PathInterface $new): void;

  }