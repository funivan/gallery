<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Pages\Download;


  use Funivan\CabbageFs\PathInterface;
  use Funivan\CabbageFramework\Http\Request\Parameters;
  use Funivan\CabbageFramework\Router\PathRoute\PathUrl;

  /**
   *
   */
  final class DownloadUrl extends PathUrl {

    public const PREFIX = '/download/';


    /**
     * @param PathInterface $path
     */
    public function __construct(PathInterface $path) {
      parent::__construct(self::PREFIX, new Parameters(['path' => $path->assemble()]));
    }

  }