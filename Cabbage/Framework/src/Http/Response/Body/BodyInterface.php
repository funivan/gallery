<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Http\Response\Body;

  /**
   *
   */
  interface BodyInterface {

    /**
     * Send content to the client
     *
     * @return void
     */
    public function send(): void;

  }