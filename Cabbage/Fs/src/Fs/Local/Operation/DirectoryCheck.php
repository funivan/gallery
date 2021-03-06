<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFs\Fs\Local\Operation;

  use Funivan\CabbageFs\PathInterface;

  /**
   *
   */
  class DirectoryCheck implements DirectoryOperation {

    /**
     * @param PathInterface $path
     * @return bool
     */
    final public function perform(PathInterface $path): bool {
      return is_dir($path->assemble());
    }

  }
