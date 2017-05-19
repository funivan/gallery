<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Pages\Actions\Visibility;

  use Funivan\Gallery\App\Image\Image;
  use Funivan\Gallery\App\Pages\Actions\ImageActionInterface;

  /**
   *
   */
  class VisibilitySetAction implements ImageActionInterface {

    /**
     * @param Image $image
     */
    public final function execute(Image $image) {

    }


    /**
     * @return string
     */
    public final function id(): string {
      return 'visibility_set';
    }

  }