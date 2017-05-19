<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Pages\ThumbPage;

  use Funivan\Gallery\FileStorage\PathInterface;
  use Funivan\Gallery\Framework\Http\Request\Parameters;
  use Funivan\Gallery\Framework\Router\PathRoute\PathUrl;

  /**
   *
   */
  final class ThumbUrl extends PathUrl {

    const PREFIX = '/img/';


    /**
     * @todo take a look: Not code free constructor
     *
     * @param PathInterface $path
     */
    public function __construct(PathInterface $path) {
      parent::__construct(self::PREFIX, new Parameters(['path' => $path->assemble()]));
    }

  }