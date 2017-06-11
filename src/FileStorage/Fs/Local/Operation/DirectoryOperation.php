<?php

  namespace Funivan\Gallery\FileStorage\Fs\Local\Operation;

  use Funivan\Gallery\FileStorage\PathInterface;

  interface DirectoryOperation {

    public function perform(PathInterface $path): bool;

  }