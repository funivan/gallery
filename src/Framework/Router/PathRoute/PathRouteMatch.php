<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Router\PathRoute;

  use Funivan\Gallery\Framework\Http\Request\Parameters;
  use Funivan\Gallery\Framework\Http\Request\RequestInterface;
  use Funivan\Gallery\Framework\Router\Match\EmptyMatchResult;
  use Funivan\Gallery\Framework\Router\Match\MatchResult;
  use Funivan\Gallery\Framework\Router\Match\MatchResultInterface;
  use Funivan\Gallery\Framework\Router\RouteMatchInterface;

  /**
   *
   */
  class PathRouteMatch implements RouteMatchInterface {

    /**
     * @var string
     */
    private $path;


    /**
     * @param string $path
     */
    public function __construct(string $path) {
      $this->path = $path;
    }


    /**
     * @param RequestInterface $request
     * @return MatchResultInterface
     */
    public final function match(RequestInterface $request): MatchResultInterface {
      if ($request->server()->value('PATH_INFO') === $this->path) {
        $result = new MatchResult(true, new Parameters([]));
      } else {
        $result = new EmptyMatchResult();
      }
      return $result;
    }

  }