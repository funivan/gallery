<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFs\Finder;

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
    final public function items(): \Iterator {
      $items = iterator_to_array(
        $this->original->items()
      );
      if ($this->reverse) {
        arsort($items);
      } else {
        sort($items);
      }
      return new \ArrayIterator($items);
    }

  }
