<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\Framework\DataStructures\Stack;

  /**
   *
   */
  class StringStack implements StringStackInterface {


    /**
     * @var string[]
     */
    private $elements = [];


    /**
     * @param string $data
     */
    public final function push(string $data): void {
      $this->elements[] = $data;
    }


    /**
     * @return string
     */
    public final function pop(): string {
      $element = array_pop($this->elements);
      if (null === $element) {
        throw new \RuntimeException('Stack is empty');
      }
      /** @var string $element */
      return $element;
    }


    /**
     * Check if there are some elements in the stack
     *
     * @return bool
     */
    public final function empty(): bool {
      return count($this->elements) === 0;
    }

  }