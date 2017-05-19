<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\FileStorage\File;

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
    public function write(string $content);


    /**
     * Check if file exists
     *
     * @return bool
     */
    public function exists(): bool;


    /**
     * @return void
     */
    public function remove();

  }