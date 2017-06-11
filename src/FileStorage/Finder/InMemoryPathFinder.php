<?php

  namespace Funivan\Gallery\FileStorage\Finder;

  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;
  use Funivan\Gallery\FileStorage\PathInterface;

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
    public function items(): \Iterator {
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
    protected function tree(): array {
      $tree = [];
      foreach ($this->items as $rawPath) {
        foreach ($this->all(new LocalPath($rawPath)) as $path) {
          $tree[$path->assemble()] = $path;
        }
      }
      return $tree;
    }

  }
