<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\DataStructures\ParsedString;


  /**
   *
   */
  interface ParsedStringInterface {

    /**
     * @param string $token
     * @param string $value
     * @return ParsedString
     */
    public function with(string $token, string $value): ParsedString;


    /**
     * @param string $token
     * @return ParsedString
     */
    public function without(string $token): ParsedString;


    /**
     * @param string $token
     * @return bool
     */
    public function has(string $token): bool;


    /**
     * @return string
     */
    public function value(): string;
  }