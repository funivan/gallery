<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Pages\Auth\LoginPage;

  use Funivan\Gallery\Framework\Http\Request\Parameters;
  use Funivan\Gallery\Framework\Router\PathRoute\PathUrl;

  /**
   *
   */
  final class LoginUrl extends PathUrl {

    public const PREFIX = '/login/';


    /**
     *
     */
    public function __construct() {
      parent::__construct(self::PREFIX, new Parameters([]));
    }

  }