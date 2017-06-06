<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\FileStorage\File;

  use Funivan\Gallery\FileStorage\PathInterface;

  /**
   *
   */
  interface FileInterface {

    /**
     * Return content of the file
     *
     * @return string
     */
    public function read(): string;


    /**
     * Write content to the file
     *
     * @param string $content
     * @return void
     */
    public function write(string $content): void;


    /**
     * Check if file exists
     *
     * @return bool
     */
    public function exists(): bool;


    /**
     * @return void
     */
    public function remove(): void;


    /**
     * @param string $type
     * @return string
     */
    public function meta(string $type): string;


    /**
     * @return PathInterface
     */
    public function path(): PathInterface;


    /**
     * @param PathInterface $path
     * @return FileInterface
     */
    public function move(PathInterface $path): FileInterface;


  }