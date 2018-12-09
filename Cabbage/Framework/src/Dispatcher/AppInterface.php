<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Dispatcher;

  use Funivan\CabbageFramework\Http\Request\Request;


  /**
   * Run dispatcher and send response to the client.
   */
  interface AppInterface {

    /**
     * Send response to the client
     *
     * @param Request $request
     * @return void
     */
    public function run(Request $request): void;
  }