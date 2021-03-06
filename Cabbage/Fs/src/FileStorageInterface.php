<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFs;

  use Funivan\CabbageFs\Finder\FinderInterface;

  /**
   */
  interface FileStorageInterface {

    public const TYPE_UNKNOWN = 'unknown';

    public const TYPE_FILE = 'file';

    public const TYPE_DIRECTORY = 'directory';


    /**
     * @param PathInterface $path
     * @return FinderInterface
     */
    public function finder(PathInterface $path): FinderInterface;


    /**
     * @param PathInterface $path
     * @param string $name
     * @return string
     */
    public function meta(PathInterface $path, string $name): string;


    /**
     * @param PathInterface $path
     * @return string
     */
    public function type(PathInterface $path): string;


    /**
     * @param PathInterface $path
     * @param string $data
     * @return void
     */
    public function write(PathInterface $path, string $data): void;


    /**
     * @param PathInterface $path
     * @return string
     */
    public function read(PathInterface $path): string;


    /**
     * @param PathInterface $path
     * @return void
     */
    public function remove(PathInterface $path): void;


    /**
     * @param PathInterface $old
     * @param PathInterface $new
     * @return void
     */
    public function move(PathInterface $old, PathInterface $new): void;

  }