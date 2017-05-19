<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Pages\Actions;

  use Funivan\Gallery\FileStorage\File\FileInterface;

  /**
   *
   */
  interface ImageActionInterface {

    /**
     * @return string
     */
    public function id(): string;


    /**
     * @param FileInterface $image
     * @return void
     */
    public function execute(FileInterface $image);


  }