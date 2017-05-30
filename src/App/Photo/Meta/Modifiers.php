<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Photo\Meta;

  /**
   *
   */
  class Modifiers {

    /**
     * @var \string[]
     */
    private $modifiers;


    /**
     * @param \string[] ...$modifiers
     */
    public function __construct(string ...$modifiers) {
      $this->modifiers = $modifiers;
    }


    /**
     * @param string $modifier
     * @return bool
     */
    public function has(string $modifier): bool {
      return in_array($modifier, $this->modifiers);
    }


    /**
     * @param string $modifier
     * @return Modifiers
     */
    public function remove(string $modifier): Modifiers {
      return new self(... array_diff($this->all(), [$modifier]));
    }


    public function add(string $modifier): Modifiers {
      $modifiers = array_merge($this->all(), [$modifier]);
      return new self(...$modifiers);
    }


    public function all() {
      $modifiers = array_unique($this->modifiers);
      sort($modifiers);
      return $modifiers;
    }

  }