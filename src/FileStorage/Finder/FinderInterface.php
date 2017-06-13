<?php
  declare(strict_types = 1);

  namespace Funivan\Gallery\FileStorage\Finder;

  use Funivan\Gallery\FileStorage\PathInterface;

  /**
   *
   */
  interface FinderInterface {

    /**
     * @return PathInterface[]|\Iterator
     */
    public function items(): \Iterator;

  }
