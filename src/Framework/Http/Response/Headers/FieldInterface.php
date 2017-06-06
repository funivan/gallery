<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Http\Response\Headers;

  /**
   * @see https://www.rfc-editor.org/rfc/rfc7230.txt 3.2
   */
  interface FieldInterface {

    /**
     * @return string
     */
    public function name(): string;


    /**
     * @return string
     */
    public function value(): string;

  }