<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Router;

  use Funivan\CabbageFramework\Dispatcher\DispatcherInterface;
  use Funivan\CabbageFramework\Http\Request\RequestInterface;
  use Funivan\CabbageFramework\Http\Response\ResponseInterface;
  use Funivan\CabbageFramework\Router\Match\Result\MatchResultInterface;
  use Funivan\CabbageFramework\Router\Match\RouteMatchInterface;

  /**
   *
   */
  class Route implements RouteInterface {

    /**
     * @var RouteMatchInterface
     */
    private $matcher;

    /**
     * @var DispatcherInterface
     */
    private $dispatcher;


    public function __construct(RouteMatchInterface $match, DispatcherInterface $dispatcher) {
      $this->matcher = $match;
      $this->dispatcher = $dispatcher;
    }


    final public function handle(RequestInterface $request): ResponseInterface {
      return $this->dispatcher->handle($request);
    }


    final public function match(RequestInterface $request): MatchResultInterface {
      return $this->matcher->match($request);
    }

  }