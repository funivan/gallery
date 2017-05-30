<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\Framework\DataStructures\BufferedString;

  /**
   *
   */
  interface BufferedStringInterface {

    /**
     * @return bool
     */
    public function empty(): bool;


    /**
     * @param string $string
     * @return self
     */
    public function append(string $string) : BufferedStringInterface;


    /**
     * @return self
     */
    public function clear() : BufferedStringInterface;


    /**
     * @return string
     */
    public function read(): string;

  }