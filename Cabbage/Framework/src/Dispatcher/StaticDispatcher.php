<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Dispatcher;

  use Funivan\CabbageFramework\Http\Request\RequestInterface;
  use Funivan\CabbageFramework\Http\Response\ResponseInterface;

  /**
   *
   */
  class StaticDispatcher implements DispatcherInterface {

    /**
     * @var ResponseInterface
     */
    private $response;


    /**
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response) {
      $this->response = $response;
    }


    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    final public function handle(RequestInterface $request): ResponseInterface {
      return $this->response;
    }
  }