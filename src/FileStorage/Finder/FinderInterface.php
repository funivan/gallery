<?php

  namespace Funivan\Gallery\FileStorage\Finder;

  use Funivan\Gallery\FileStorage\PathInterface;

  interface FinderInterface {

    /**
     * @return PathInterface[]
     */
    public function items(): \Iterator;

  }
