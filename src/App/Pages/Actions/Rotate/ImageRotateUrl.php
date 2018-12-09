<?php
  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Pages\Actions\Rotate;

  use Funivan\CabbageFramework\Http\Request\Parameters;
  use Funivan\CabbageFramework\Router\PathRoute\PathUrl;

  /**
   *
   */
  class ImageRotateUrl extends PathUrl {

    public const PREFIX = '/action/change/rotate';


    /**
     * @param int $angle
     */
    public function __construct(int $angle) {
      parent::__construct(self::PREFIX, new Parameters(['angle' => $angle]));
    }

  }
