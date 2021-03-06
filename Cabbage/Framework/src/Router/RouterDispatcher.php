<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Router;

  use Funivan\CabbageFramework\Dispatcher\DispatcherInterface;
  use Funivan\CabbageFramework\Http\Request\RequestInterface;
  use Funivan\CabbageFramework\Http\Response\ResponseInterface;
  use Funivan\CabbageFramework\Router\Exception\RouteNotFoundException;

  /**
   * Iterate over all routes
   *  if route match
   *    - then forward request to the route dispatcher
   * Throw exception if all routes does not correspond to the client request
   */
  class RouterDispatcher implements DispatcherInterface {

    /**
     * @var RouteInterface[]
     */
    private $routes;


    /**
     * @param RouteInterface[] $routes
     */
    public function __construct(array $routes) {
      $this->routes = $routes;
    }


    /**
     *
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws \Exception
     */
    final public function handle(RequestInterface $request): ResponseInterface {
      foreach ($this->routes as $route) {
        $matchResult = $route->match($request);
        if ($matchResult->matched()) {
          $request = $request->withParameters($matchResult->parameters());
          return $route->handle($request);
        }
      }
      throw new RouteNotFoundException(
        sprintf('Route not found. Number of routes: %s', count($this->routes))
      );
    }

  }