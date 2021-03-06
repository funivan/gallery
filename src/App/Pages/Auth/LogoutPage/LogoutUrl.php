<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Pages\Auth\LogoutPage;

  use Funivan\CabbageFramework\Http\Request\Parameters;
  use Funivan\CabbageFramework\Router\PathRoute\PathUrl;

  /**
   *
   */
  final class LogoutUrl extends PathUrl {

    public const PREFIX = '/logout/';


    /**
     *
     */
    public function __construct() {
      parent::__construct(self::PREFIX, new Parameters([]));
    }

  }