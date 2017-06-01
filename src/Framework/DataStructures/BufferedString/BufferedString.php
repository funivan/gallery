<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\Framework\DataStructures\BufferedString;

  /**
   *
   */
  class BufferedString implements BufferedStringInterface {

    /**
     * @var string
     */
    private $string = '';

    /**
     * @var bool
     */
    private $empty = true;


    /**
     * Check if buffer is empty.
     * Important! If we store empty string than our buffer is not empty any more
     *
     * @return bool
     */
    public final function empty(): bool {
      return $this->empty;
    }


    /**
     * @param string $string
     * @return BufferedStringInterface
     */
    public final function append(string $string): BufferedStringInterface {
      $this->string = $this->string . $string;
      $this->empty = false;
      return $this;
    }


    /**
     * @return BufferedStringInterface
     */
    public final function clear(): BufferedStringInterface {
      $this->string = '';
      $this->empty = true;
      return $this;
    }


    /**
     * @return string
     */
    public final function read(): string {
      if ($this->empty) {
        throw new \RuntimeException('Buffer is empty');
      }
      return $this->string;
    }

  }