<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Photo;

  use Funivan\Gallery\FileStorage\File\FileInterface;

  /**
   *
   */
  interface PhotoInterface {

    /**
     * @return StateInterface
     */
    public function favourite(): StateInterface;


    /**
     * @return FileInterface
     */
    public function original(): FileInterface;


    /**
     * @return string
     */
    public function name(): string;

  }