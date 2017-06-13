<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\FileStorage\Finder;

  use Funivan\Gallery\FileStorage\FileStorageInterface;
  use Funivan\Gallery\FileStorage\PathInterface;

  /**
   *
   */
  class TypeFilter implements FinderInterface {

    /**
     * @var FinderInterface
     */
    private $original;

    /**
     * @var string
     */
    private $type;

    /**
     * @var FileStorageInterface
     */
    private $storage;


    /**
     * @param string $type
     * @param FileStorageInterface $storage
     * @param FinderInterface $original
     */
    public function __construct(string $type, FileStorageInterface $storage, FinderInterface $original) {
      $this->original = $original;
      $this->type = $type;
      $this->storage = $storage;
    }


    /**
     * @return PathInterface[]|\Iterator
     */
    public function items(): \Iterator {
      foreach ($this->original->items() as $item) {
        if ($this->storage->type($item) === $this->type) {
          yield $item;
        }
      }
    }

  }