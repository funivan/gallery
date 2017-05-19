<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\Framework\Http\Response;

  use Funivan\Gallery\Framework\Http\Response\Headers\FieldInterface;

  /**
   * @see https://www.rfc-editor.org/rfc/rfc7230.txt
   */
  interface HeadersInterface {


    /**
     * @return FieldInterface[]
     */
    public function fields(): array;


    /**
     * @param HeadersInterface $headers
     * @return HeadersInterface
     */
    public function merge(HeadersInterface $headers): HeadersInterface;

  }