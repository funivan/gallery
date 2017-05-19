<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\Framework\Auth;

  use Funivan\Gallery\Framework\Dispatcher\DispatcherInterface;
  use Funivan\Gallery\Framework\Http\Request\RequestInterface;
  use Funivan\Gallery\Framework\Http\Response\Redirect\RedirectResponse;
  use Funivan\Gallery\Framework\Http\Response\ResponseInterface;
  use Funivan\Gallery\Framework\Router\RouteBuildInterface;

  /**
   * Check if client is authenticated and execute next dispatcher
   *  or redirect user to the login url
   */
  class AuthenticationDispatcher implements DispatcherInterface {

    /**
     * @var DispatcherInterface
     */
    private $original;

    /**
     * @var AuthComponentInterface
     */
    private $authComponent;

    /**
     * @var RouteBuildInterface
     */
    private $loginRoute;


    /**
     * @param AuthComponentInterface $authComponent
     * @param RouteBuildInterface $loginRoute
     * @param DispatcherInterface $original
     */
    public function __construct(AuthComponentInterface $authComponent, RouteBuildInterface $loginRoute, DispatcherInterface $original) {
      $this->original = $original;
      $this->authComponent = $authComponent;
      $this->loginRoute = $loginRoute;
    }


    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public final function handle(RequestInterface $request): ResponseInterface {
      if ($this->authComponent->authenticated()) {
        $result = $this->original->handle($request);
      } else {
        $result = new RedirectResponse($this->loginRoute, 301);
      }
      return $result;
    }

  }