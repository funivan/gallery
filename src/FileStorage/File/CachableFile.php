<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\FileStorage\File;

  use Funivan\Gallery\FileStorage\PathInterface;
  use Funivan\Gallery\Framework\DataStructures\BufferedString\BufferedString;
  use Funivan\Gallery\Framework\DataStructures\BufferedString\BufferedStringInterface;

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
    public final function remove(): void {
      $this->original->remove();
      $this->content->clear();
    }


    /**
     * @param string $content
     * @return void
     */
    public final function write(string $content): void {
      $this->original->write($content);
      $this->content->clear()->append($content);
    }


    /**
     * @param string $type
     * @return string
     */
    public function meta(string $type): string {
      return $this->original->meta($type);
    }


    /**
     * @return PathInterface
     */
    public function path(): PathInterface {
      return $this->original->path();
    }


    /**
     * @param PathInterface $path
     * @return FileInterface
     */
    public function move(PathInterface $path): FileInterface {
      return $this->original->move($path);
    }

  }