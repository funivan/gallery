<?php
  declare(strict_types = 1);

  namespace Funivan\CabbageFs\Fs\Local\Operation;

  use Funivan\CabbageFs\PathInterface;

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