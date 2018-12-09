<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Pages\IndexPage;

  use Funivan\CabbageFramework\Http\Request\Parameters;
  use Funivan\CabbageFramework\Router\PathRoute\PathUrl;

  /**
   *
   */
  final class IndexUrl extends PathUrl {

    public const PREFIX = '/';


    /**
     */
    public function __construct() {
      parent::__construct(self::PREFIX, new Parameters([]));
    }

  }