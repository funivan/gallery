<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\FileStorage\Finder;

  /**
   *
   */
  class OrderByName implements FinderInterface {

    /**
     * @var FinderInterface
     */
    private $original;

    /**
     * @var bool
     */
    private $reverse;


    /**
     * @param FinderInterface $original
     * @param bool $reverse
     */
    public function __construct(FinderInterface $original, bool $reverse = true) {
      $this->original = $original;
      $this->reverse = $reverse;
    }


    /**
     * @return \Iterator
     */
    public function items(): \Iterator {
      $items = $this->original->items();
      $items = iterator_to_array($items);
      if ($this->reverse) {
        arsort($items);
      } else {
        sort($items);
      }
      return new \ArrayIterator($items);
    }


  }
