<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Router;

  use Funivan\Gallery\Framework\Dispatcher\DispatcherInterface;
  use Funivan\Gallery\Framework\Router\Match\RouteMatchInterface;

  /**
   *
   */
  interface RouteInterface extends RouteMatchInterface, DispatcherInterface {


  }