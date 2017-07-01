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
     * @param FinderInterface $original
     */
    public function __construct(FinderInterface $original) {
      $this->original = $original;
    }


    /**
     * @return \Iterator
     */
    public function items(): \Iterator {
      $items = $this->original->items();
      $items = iterator_to_array($items);
      arsort($items);
      return new \ArrayIterator($items);
    }


  }
