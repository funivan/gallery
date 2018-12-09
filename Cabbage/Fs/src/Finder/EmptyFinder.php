<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFs\Finder;

  use Funivan\CabbageFs\PathInterface;

  /**
   *
   */
  class EmptyFinder implements FinderInterface {

    /** @noinspection PhpDocSignatureInspection */

    /**
     * @return PathInterface[]|\Iterator
     */
    final public function items(): \Iterator {
      return new \EmptyIterator();
    }

  }
