<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\FileStorage\Finder;

  use Funivan\Gallery\FileStorage\PathInterface;

  class NameFilter implements FinderInterface {

    /**
     * @var string
     */
    private $regexp;

    /**
     * @var FinderInterface
     */
    private $original;


    /**
     * @param string $regex
     * @param FinderInterface $original
     */
    public function __construct(string $regex, FinderInterface $original) {
      $this->regexp = $regex;
      $this->original = $original;
    }


    /**
     * @return PathInterface[]
     */
    public function items(): \Iterator {
      foreach ($this->original->items() as $path) {
        if (preg_match($this->regexp, $path->name()) === 1) {
          yield $path;
        }
      }
    }

  }
