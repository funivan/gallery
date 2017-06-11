<?php

  namespace Funivan\Gallery\FileStorage\Fs\Local\Operation;

  use Funivan\Gallery\FileStorage\PathInterface;

  /**
   *
   */
  interface DirectoryOperation {

    /**
     * @param PathInterface $path
     * @return bool
     */
    public function perform(PathInterface $path): bool;

  }