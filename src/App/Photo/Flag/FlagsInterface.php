<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Photo\Flag;

  use Funivan\Gallery\FileStorage\File\FileInterface;


  /**
   *
   */
  interface FlagsInterface {

    const FAVOURITE = 'f';

    const DELETED = 'd';

    const PRIVATE = 'p';


    /**
     * @param string $type
     * @return FileInterface
     */
    public function set(string $type): FileInterface;


    /**
     * @param string $type
     * @return FileInterface
     */
    public function remove(string $type): FileInterface;


    /**
     * @param string $type
     * @return bool
     */
    public function has(string $type): bool;

  }