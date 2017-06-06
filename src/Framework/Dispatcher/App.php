<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Dispatcher;

  use Funivan\Gallery\Framework\Http\Request\Request;

  /**
   * Run dispatcher and send response to the client.
   */
  class App {


    /**
     * @var DispatcherInterface
     */
    private $dispatcher;


    /**
     * @param DispatcherInterface $dispatcher
     */
    public function __construct(DispatcherInterface $dispatcher) {
      $this->dispatcher = $dispatcher;
    }


    /**
     * Send response to the client
     *
     * @param Request $request
     * @return void
     */
    public final function run(Request $request): void {
      $response = $this->dispatcher->handle($request);
      $reason = $response->status();
      $code = $reason->code();
      header(sprintf('HTTP/%s %s %s', 1.1, $code, $reason->phrase()), true, $code);
      $headers = $response->headers();
      foreach ($headers->fields() as $line) {
        header($line->name() . ': ' . $line->value(), true, $code);
      }
      $response->body()->send();
    }
  }