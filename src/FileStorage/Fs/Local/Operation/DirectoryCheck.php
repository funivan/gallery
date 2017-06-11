<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\FileStorage\Fs\Local\Operation;

  use Funivan\Gallery\FileStorage\PathInterface;

  /**
   *
   */
  class DirectoryCheck implements DirectoryOperation {

    /**
     * @param PathInterface $path
     * @return bool
     */
    public function perform(PathInterface $path): bool {
      return is_dir($path->assemble());
    }

  }
