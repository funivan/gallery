<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFs\Finder;

  use Funivan\CabbageFs\Fs\Local\LocalPath;
  use Funivan\CabbageFs\PathInterface;

  /**
   *
   */
  class InMemoryPathFinder implements FinderInterface {

    /**
     * @var array|\string[]
     */
    private $items;

    /**
     * @var PathInterface
     */
    private $pathFilter;


    /**
     * @param string[] $items
     * @param PathInterface $pathFilter
     */
    public function __construct(array $items, PathInterface $pathFilter) {
      $this->items = $items;
      $this->pathFilter = $pathFilter;
    }


    /**
     * @return PathInterface[]|\Iterator
     */
    final public function items(): \Iterator {
      $tree = $this->tree();
      foreach ($tree as $path) {
        if (!$path->isRoot() and $path->previous()->equal($this->pathFilter)) {
          yield $path;
        }
      }
    }


    /**
     * @param PathInterface $path
     * @return PathInterface[]|\Generator
     */
    private function all(PathInterface $path): \Generator {
      $prev = $path;
      do {
        yield $prev;
      } while (!$prev->isRoot() and $prev = $prev->previous());
    }


    /**
     * @return PathInterface[]
     */
    private function tree(): array {
      $tree = [];
      foreach ($this->items as $rawPath) {
        foreach ($this->all(new LocalPath($rawPath)) as $path) {
          $tree[$path->assemble()] = $path;
        }
      }
      return $tree;
    }

  }
