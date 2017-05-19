<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Pages\Actions\Favourite;

  use Funivan\Gallery\App\Pages\Actions\ImageActionInterface;
  use Funivan\Gallery\FileStorage\File\FileInterface;

  /**
   *
   */
  class FavouriteSetAction implements ImageActionInterface {


    /**
     * @param FileInterface $image
     */
    public final function execute(FileInterface $image) {

    }


    /**
     * @return string
     */
    public final function id(): string {
      return 'favourite_set';
    }

  }
