<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Auth;

  use Funivan\Gallery\Framework\Dispatcher\DispatcherInterface;
  use Funivan\Gallery\Framework\Http\Request\RequestInterface;
  use Funivan\Gallery\Framework\Http\Response\ResponseInterface;

  /**
   * Check if client is authenticated and execute next dispatcher
   *  or execute fallback dispatcher
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
     * @var DispatcherInterface
     */
    private $fallback;


    /**
     * @param AuthComponentInterface $authComponent
     * @param DispatcherInterface $fallback
     * @param DispatcherInterface $original
     */
    public function __construct(AuthComponentInterface $authComponent, DispatcherInterface $fallback, DispatcherInterface $original) {
      $this->authComponent = $authComponent;
      $this->fallback = $fallback;
      $this->original = $original;
    }


    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    final public function handle(RequestInterface $request): ResponseInterface {
      if ($this->authComponent->authenticated()) {
        $result = $this->original->handle($request);
      } else {
        $result = $this->fallback->handle($request);
      }
      return $result;
    }

  }