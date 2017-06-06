<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Dispatcher;

  use Funivan\Gallery\Framework\Http\Request\RequestInterface;
  use Funivan\Gallery\Framework\Http\Response\ResponseInterface;

  /**
   * Convert Request to the Response
   */
  interface DispatcherInterface {

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function handle(RequestInterface $request): ResponseInterface;

  }