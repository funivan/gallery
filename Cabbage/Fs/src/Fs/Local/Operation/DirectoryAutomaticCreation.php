<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFs\Fs\Local\Operation;

  use Funivan\CabbageFs\PathInterface;

  /**
   *
   */
  class DirectoryAutomaticCreation implements DirectoryOperation {

    /**
     * @param PathInterface $path
     * @return bool
     */
    final public function perform(PathInterface $path): bool {
      $dir = $path->assemble();
      if (is_dir($dir)) {
        $result = true;
      } else {
        $result = @mkdir($dir, 0777, true);
      }
      return $result;
    }

  }
