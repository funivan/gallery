<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Router;

  use Funivan\Gallery\Framework\Dispatcher\DispatcherInterface;
  use Funivan\Gallery\Framework\Http\Request\RequestInterface;
  use Funivan\Gallery\Framework\Http\Response\ResponseInterface;
  use Funivan\Gallery\Framework\Router\Match\Result\MatchResultInterface;
  use Funivan\Gallery\Framework\Router\Match\RouteMatchInterface;

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