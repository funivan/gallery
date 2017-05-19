<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\Framework\Router\Match;

  use Funivan\Gallery\Framework\Http\Request\Parameters;
  use Funivan\Gallery\Framework\Http\Request\RequestInterface;
  use Funivan\Gallery\Framework\Router\RouteMatchInterface;

  /**
   *
   */
  final class SuccessRouteMatch implements RouteMatchInterface {


    /**
     * @param RequestInterface $request
     * @return MatchResultInterface
     */
    public function match(RequestInterface $request): MatchResultInterface {
      return new MatchResult(true, new Parameters([]));
    }


  }