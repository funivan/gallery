<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Pages\Auth\LogoutPage;

  use Funivan\Gallery\Framework\Http\Request\Parameters;
  use Funivan\Gallery\Framework\Router\PathRoute\PathUrl;

  /**
   *
   */
  final class LogoutUrl extends PathUrl {

    const PREFIX = '/logout/';


    /**
     *
     */
    public function __construct() {
      parent::__construct(self::PREFIX, new Parameters([]));
    }

  }