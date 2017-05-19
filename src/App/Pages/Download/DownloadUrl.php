<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Pages\Download;


  use Funivan\Gallery\FileStorage\PathInterface;
  use Funivan\Gallery\Framework\Http\Request\Parameters;
  use Funivan\Gallery\Framework\Router\PathRoute\PathRouteBuild;

  /**
   *
   */
  final class DownloadUrl extends PathRouteBuild {

    const PREFIX = '/download/';


    /**
     * @param PathInterface $path
     */
    public function __construct(PathInterface $path) {
      parent::__construct(self::PREFIX, new Parameters(['path' => $path->assemble()]));
    }

  }