<?php

  namespace Funivan\Gallery\App\Pages\Actions\Rotate;

  use Funivan\Gallery\FileStorage\PathInterface;
  use Funivan\Gallery\Framework\Http\Request\Parameters;
  use Funivan\Gallery\Framework\Router\PathRoute\PathUrl;

  /**
   *
   */
  final class ImageRotateRightUrl extends PathUrl {

    const PREFIX = '/action/change/rotate-right';


    /**
     * @param PathInterface $path
     */
    public function __construct(PathInterface $path) {
      parent::__construct(self::PREFIX, new Parameters(['path' => $path->assemble()]));
    }

  }