<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Pages\Actions;

  use Funivan\Gallery\FileStorage\File\FileInterface;

  /**
   *
   */
  interface ImageActionInterface {


    /**
     * @param FileInterface $image
     * @return void
     */
    public function execute(FileInterface $image);


  }