<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\FileStorage\File;

  use Funivan\Gallery\Framework\DataStructures\String\BufferedString;
  use Funivan\Gallery\Framework\DataStructures\String\BufferedStringInterface;

  /**
   *
   */
  class CachableFile implements FileInterface {

    /**
     * @var FileInterface
     */
    private $original;

    /**
     * @var BufferedStringInterface
     */
    private $content;


    /**
     * @param $original
     */
    public function __construct(FileInterface $original) {
      $this->original = $original;
      $this->content = new BufferedString();
    }


    /**
     * @return string
     */
    public final function read(): string {
      if ($this->content->empty()) {
        $this->content->append($this->original->read());
      }
      return $this->content->read();
    }


    /**
     * We can go deeper and even cache exists call
     *
     * @return bool
     */
    public final function exists(): bool {
      return $this->original->exists();
    }


    /**
     * Remove original file and content from the memory
     *
     * @return void
     */
    public final function remove() {
      $this->original->remove();
      $this->content->clear();
    }


    /**
     * @param string $content
     * @return void
     */
    public final function write(string $content) {
      $this->original->write($content);
      $this->content->clear()->append($content);
    }

  }