<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\DataStructures\Stack;


  /**
   *
   */
  interface StringStackInterface {

    /**
     * Add element to the end of the array
     *
     * @param string $data
     */
    public function push(string $data): void;


    /**
     * @return string
     */
    public function pop(): string;


    /**
     * Check if there are some elements in the stack
     *
     * @return bool
     */
    public function empty(): bool;

  }