<?php
  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Pages\Actions\Rotate;

  use Funivan\Gallery\Framework\Http\Request\Parameters;
  use Funivan\Gallery\Framework\Router\PathRoute\PathUrl;

  /**
   *
   */
  class ImageRotateRightUrl extends PathUrl {

    const PREFIX = '/action/change/rotate-right';


    /**
     *
     */
    public function __construct() {
      parent::__construct(self::PREFIX, new Parameters([]));
    }

  }
