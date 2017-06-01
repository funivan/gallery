<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Pages\Actions;

  use Funivan\Gallery\Framework\Http\Request\RequestInterface;
  use Funivan\Gallery\Framework\Router\Match\MatchResultInterface;
  use Funivan\Gallery\Framework\Router\ParameterRoute\ParameterRoutMatch;
  use Funivan\Gallery\Framework\Router\ParameterRoute\SameParameterConstrain;
  use Funivan\Gallery\Framework\Router\PathRoute\PathRouteMatch;
  use Funivan\Gallery\Framework\Router\RouteMatchInterface;

  /**
   *
   */
  final class ActionRouteMatch implements RouteMatchInterface {

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
    public function match(RequestInterface $request): MatchResultInterface {
      //@todo use POST instead of GET
      return ParameterRoutMatch::createWithNext(
        'GET', new SameParameterConstrain('flag', $this->flag),
        new PathRouteMatch($this->path)
      )->match($request);
    }

  }