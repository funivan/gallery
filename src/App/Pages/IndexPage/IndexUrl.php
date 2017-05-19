<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Pages\IndexPage;

  use Funivan\Gallery\Framework\Http\Request\Parameters;
  use Funivan\Gallery\Framework\Router\PathRoute\PathUrl;

  /**
   *
   */
  final class IndexUrl extends PathUrl {

    const PREFIX = '/';


    /**
     */
    public function __construct() {
      parent::__construct(self::PREFIX, new Parameters([]));
    }

  }