<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Photo;

  use Funivan\Gallery\App\Photo\Meta\MetaFlagInterface;
  use Funivan\Gallery\FileStorage\File\FileInterface;

  /**
   *
   */
  interface PhotoInterface {

    /**
     * @return MetaFlagInterface
     */
    public function favourite(): MetaFlagInterface;


    /**
     * @return MetaInformation
     */
    public function meta(): MetaInformation;


    /**
     * @return FileInterface
     */
    public function file(): FileInterface;


  }