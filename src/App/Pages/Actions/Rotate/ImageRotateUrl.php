<?php
  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Pages\Actions\Rotate;

  use Funivan\Gallery\Framework\Http\Request\Parameters;
  use Funivan\Gallery\Framework\Router\PathRoute\PathUrl;

  /**
   *
   */
  class ImageRotateUrl extends PathUrl {

    const PREFIX = '/action/change/rotate';


    /**
     * @param int $angle
     */
    public function __construct(int $angle) {
      parent::__construct(self::PREFIX, new Parameters(['angle' => $angle]));
    }

  }
