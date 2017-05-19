<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\Framework\Http\Response;

  /**
   * @see https://www.rfc-editor.org/rfc/rfc7230.txt 3.1.2
   */
  interface StatusInterface {

    /**
     * Should be 3DIGIT
     *
     * @return int
     */
    public function code(): int;


    /**
     * Reason phrase
     *
     * @return string
     */
    public function phrase(): string;

  }