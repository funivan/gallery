<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Pages\Actions\Visibility;

  use Funivan\Gallery\App\Pages\Actions\ImageActionInterface;
  use Funivan\Gallery\FileStorage\File\FileInterface;

  /**
   *
   */
  class VisibilityRemoveAction implements ImageActionInterface {

    /**
     * @param FileInterface $image
     */
    public final function execute(FileInterface $image) {

    }


    /**
     * @return string
     */
    public final function id(): string {
      return 'visibility_remove';
    }

  }