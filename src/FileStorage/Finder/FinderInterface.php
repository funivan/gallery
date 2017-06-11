<?php

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
