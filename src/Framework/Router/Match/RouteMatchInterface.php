<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Router\Match;

  use Funivan\Gallery\Framework\Http\Request\RequestInterface;
  use Funivan\Gallery\Framework\Router\Match\Result\MatchResultInterface;

  /**
   * Check request according to the match logic
   * and return Parameters on success
   */
  interface RouteMatchInterface {

    /**
     * @param RequestInterface $request
     * @return MatchResultInterface
     */
    public function match(RequestInterface $request): MatchResultInterface;

  }