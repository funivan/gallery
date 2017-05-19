<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Pages\Actions\Favourite;

  use Funivan\Gallery\App\Pages\Actions\ImageActionInterface;
  use Funivan\Gallery\FileStorage\File\FileInterface;

  /**
   *
   */
  class FavouriteRemoveAction implements ImageActionInterface {


    /**
     * @param FileInterface $image
     * @return void
     */
    public final function execute(FileInterface $image) {

    }


  }
