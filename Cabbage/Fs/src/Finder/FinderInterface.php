<?php
  declare(strict_types = 1);

  namespace Funivan\CabbageFs\Finder;

  use Funivan\CabbageFs\PathInterface;

  /**
   *
   */
  interface FinderInterface {

    /**
     * @return PathInterface[]|\Iterator
     */
    public function items(): \Iterator;

  }
