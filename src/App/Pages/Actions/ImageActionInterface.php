<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Pages\Actions;

  use Funivan\Gallery\FileStorage\File\FileInterface;

  /**
   *
   */
  interface ImageActionInterface {


    /**
     * @param FileInterface $photo
     * @return FileInterface
     */
    public function execute(FileInterface $photo): FileInterface;


  }