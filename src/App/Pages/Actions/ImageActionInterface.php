<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Pages\Actions;

  use Funivan\Gallery\App\Image\ImageInterface;

  /**
   *
   */
  interface ImageActionInterface {


    /**
     * @param ImageInterface $image
     * @return void
     */
    public function execute(ImageInterface $image);


  }