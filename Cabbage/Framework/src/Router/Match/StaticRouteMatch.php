<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Router\Match;

  use Funivan\CabbageFramework\Http\Request\RequestInterface;
  use Funivan\CabbageFramework\Router\Match\Result\MatchResultInterface;

  /**
   *
   */
  class StaticRouteMatch implements RouteMatchInterface {

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
    final public function match(RequestInterface $request): MatchResultInterface {
      return $this->result;
    }


  }