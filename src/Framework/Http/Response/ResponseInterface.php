<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\Framework\Http\Response;

  use Funivan\Gallery\Framework\Http\Response\Body\BodyInterface;

  /**
   * @see https://www.rfc-editor.org/rfc/rfc7230.txt
   */
  interface ResponseInterface {

    /**
     * @return StatusInterface
     */
    public function status(): StatusInterface;


    /**
     * @return HeadersInterface
     */
    public function headers(): HeadersInterface;


    /**
     * @return BodyInterface
     */
    public function body(): BodyInterface;

  }