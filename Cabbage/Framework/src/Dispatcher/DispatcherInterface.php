<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Dispatcher;

  use Funivan\CabbageFramework\Http\Request\RequestInterface;
  use Funivan\CabbageFramework\Http\Response\ResponseInterface;

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