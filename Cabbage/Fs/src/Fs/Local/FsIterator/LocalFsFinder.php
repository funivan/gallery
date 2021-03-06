<?php
  declare(strict_types = 1);

  namespace Funivan\CabbageFs\Fs\Local\FsIterator;

  use Funivan\CabbageFs\Finder\FinderInterface;
  use Funivan\CabbageFs\Fs\Local\LocalPath;
  use Funivan\CabbageFs\PathInterface;


  class LocalFsFinder implements FinderInterface {

    /**
     * @var PathInterface
     */
    private $searchPath;

    /**
     * @var \DirectoryIterator
     */
    private $iterator;


    /**
     * @param PathInterface $basePath
     * @param PathInterface $searchPath
     */
    public function __construct(PathInterface $basePath, PathInterface $searchPath) {
      $fullSearchPath = $basePath;
      if (!$searchPath->isRoot()) {
        $fullSearchPath = $fullSearchPath->next($searchPath);
      }
      $this->iterator = new \DirectoryIterator($fullSearchPath->assemble());
      $this->searchPath = $searchPath;
    }


    /**
     * @return PathInterface[]|\Iterator
     */
    final public function items(): \Iterator {
      /** @var \DirectoryIterator $item */
      foreach ($this->iterator as $item) {
        if (!$item->isDot()) {
          yield $this->searchPath->next(new LocalPath($item->getFilename()));
        }
      }
    }

  }
