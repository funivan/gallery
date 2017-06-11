<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\FileStorage\Finder;

  use Funivan\Gallery\FileStorage\PathInterface;

  /**
   *
   */
  class EmptyFinder implements FinderInterface {

    /** @noinspection PhpDocSignatureInspection */

    /**
     * @return PathInterface[]|\Iterator
     */
    public function items(): \Iterator {
      return new \EmptyIterator();
    }

  }
