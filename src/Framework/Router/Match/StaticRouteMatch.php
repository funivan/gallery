<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Router\Match;

  use Funivan\Gallery\Framework\Http\Request\RequestInterface;
  use Funivan\Gallery\Framework\Router\Match\Result\MatchResultInterface;

  /**
   *
   */
  final class StaticRouteMatch implements RouteMatchInterface {

    /**
     * @var MatchResultInterface
     */
    private $result;


    /**
     * @param MatchResultInterface $result
     */
    public function __construct(MatchResultInterface $result) {
      $this->result = $result;
    }


    /**
     * @param RequestInterface $request
     * @return MatchResultInterface
     */
    public function match(RequestInterface $request): MatchResultInterface {
      return $this->result;
    }


  }