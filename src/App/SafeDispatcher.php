<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App;

  use Funivan\Gallery\App\Pages\NotFound\ErrorResponse;
  use Funivan\Gallery\Framework\Dispatcher\DispatcherInterface;
  use Funivan\Gallery\Framework\Http\Request\RequestInterface;
  use Funivan\Gallery\Framework\Http\Response\ResponseInterface;

  /**
   * Catch error from the original dispatcher and show nice response error
   */
  class SafeDispatcher implements DispatcherInterface {

    /**
     * @var DispatcherInterface
     */
    private $original;


    /**
     * @param DispatcherInterface $original
     */
    public function __construct(DispatcherInterface $original) {
      $this->original = $original;
    }


    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    final public function handle(RequestInterface $request): ResponseInterface {
      try {
        $response = $this->original->handle($request);
      } catch (\Exception $e) {
        $response = ErrorResponse::createWithDescription(
          sprintf('Error: %s', $e->getMessage()),
          500,
          nl2br($e->getTraceAsString())
        );
      }
      return $response;
    }

  }