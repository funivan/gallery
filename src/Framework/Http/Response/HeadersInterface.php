<?php

  declare(strict_types = 1);

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
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool;


    /**
     * @param string $name
     * @return FieldInterface
     */
    public function field(string $name): FieldInterface;


    /**
     * @param HeadersInterface $headers
     * @return HeadersInterface
     */
    public function merge(HeadersInterface $headers): HeadersInterface;

  }