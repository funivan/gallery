<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Dispatcher;

  use Funivan\CabbageFramework\Http\Request\Request;


  class App implements AppInterface {


    /**
     * @var DispatcherInterface
     */
    private $dispatcher;


    public function __construct(DispatcherInterface $dispatcher) {
      $this->dispatcher = $dispatcher;
    }


    final public function run(Request $request): void {
      $response = $this->dispatcher->handle($request);
      $status = $response->status();
      $code = $status->code();
      header(sprintf('HTTP/%s %s %s', 1.1, $code, $status->phrase()), true, $code);
      $headers = $response->headers();
      foreach ($headers->fields() as $line) {
        header($line->name() . ': ' . $line->value(), true, $code);
      }
      $response->body()->send();
    }
  }