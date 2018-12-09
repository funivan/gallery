<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Photo\Flag;

  use Funivan\CabbageFs\File\FileInterface;


  /**
   *
   */
  interface FlagsInterface {

    public const FAVOURITE = 'f';

    public const DELETED = 'd';

    public const PRIVATE = 'p';


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