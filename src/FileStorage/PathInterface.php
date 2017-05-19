<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\FileStorage;

  /**
   *
   */
  interface PathInterface {

    /**
     * @return string
     */
    public function assemble(): string;


    /**
     * @param PathInterface $path
     * @return PathInterface
     */
    public function next(PathInterface $path): PathInterface;


    /**
     * @return bool
     */
    public function isRoot(): bool;


    /**
     * @return PathInterface
     */
    public function previous(): PathInterface;


    /**
     * @return string
     */
    public function name(): string;


    /**
     * Check if two paths are the same
     *
     * @param PathInterface $path
     * @return bool
     */
    public function equal(PathInterface $path): bool;

  }