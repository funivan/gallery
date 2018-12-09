<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Pages\Actions;

  use Funivan\CabbageFramework\Http\Request\RequestInterface;
  use Funivan\CabbageFramework\Router\Match\Result\MatchResultInterface;
  use Funivan\CabbageFramework\Router\Match\RouteMatchInterface;
  use Funivan\CabbageFramework\Router\ParameterRoute\ParameterRoutMatch;
  use Funivan\CabbageFramework\Router\ParameterRoute\SameParameterConstrain;
  use Funivan\CabbageFramework\Router\PathRoute\PathRouteMatch;

  /**
   *
   */
  class ActionRouteMatch implements RouteMatchInterface {

    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $flag;


    /**
     * @param string $path
     * @param string $flag
     */
    public function __construct(string $path, string $flag) {
      $this->path = $path;
      $this->flag = $flag;
    }


    /**
     * @param RequestInterface $request
     * @return MatchResultInterface
     */
    final public function match(RequestInterface $request): MatchResultInterface {
      //@todo use POST instead of GET
      return ParameterRoutMatch::createWithNext(
        'GET', new SameParameterConstrain('flag', $this->flag),
        new PathRouteMatch($this->path)
      )->match($request);
    }

  }