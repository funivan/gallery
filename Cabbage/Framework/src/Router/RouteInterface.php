<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Router;

  use Funivan\CabbageFramework\Dispatcher\DispatcherInterface;
  use Funivan\CabbageFramework\Router\Match\RouteMatchInterface;

  /**
   *
   */
  interface RouteInterface extends RouteMatchInterface, DispatcherInterface {


  }