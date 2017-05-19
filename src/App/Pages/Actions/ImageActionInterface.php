<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Pages\Actions;

  use Funivan\Gallery\App\Image\Image;

  /**
   *
   */
  interface ImageActionInterface {

    /**
     * @return string
     */
    public function id(): string;


    /**
     * @param Image $image
     * @return void
     */
    public function execute(Image $image);


  }