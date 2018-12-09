<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\DataStructures\Stack;

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
    final public function push(string $data): void {
      $this->elements[] = $data;
    }


    /**
     * @return string
     */
    final public function pop(): string {
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
    final public function empty(): bool {
      return count($this->elements) === 0;
    }

  }