<?php
  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Pages\Actions\Rotate;

  use Funivan\Gallery\FileStorage\PathInterface;
  use Funivan\Gallery\Framework\Http\Request\Parameters;
  use Funivan\Gallery\Framework\Router\PathRoute\PathUrl;

  /**
   *
   */
  class ImageRotateRightUrl extends PathUrl {

    public const PREFIX = '/action/change/rotate-right';


    /**
     * @param PathInterface $path
     */
    public function __construct(PathInterface $path) {
      parent::__construct(self::PREFIX, new Parameters(['path' => $path->assemble()]));
    }

  }
