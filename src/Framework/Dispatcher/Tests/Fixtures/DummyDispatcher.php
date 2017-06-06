<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Dispatcher\Tests\Fixtures;

  use Funivan\Gallery\Framework\Dispatcher\DispatcherInterface;
  use Funivan\Gallery\Framework\Http\Request\RequestInterface;
  use Funivan\Gallery\Framework\Http\Response\ResponseInterface;

  class DummyDispatcher implements DispatcherInterface {

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
    public function handle(RequestInterface $request): ResponseInterface {
      return $this->response;
    }
  }