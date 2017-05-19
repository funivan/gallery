<?php

  namespace Funivan\Gallery\App;

  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;
  use Funivan\Gallery\FileStorage\PathInterface;

  /**
   * @todo use file instead of plain file path
   */
  class Configuration {

    /**
     * @var string
     */
    private $filePath;


    /**
     * @param string $filePath
     */
    public function __construct(string $filePath) {
      $this->filePath = $filePath;
    }


    /**
     * @return PathInterface
     */
    public final function baseImagePath(): PathInterface {
      return new LocalPath($this->read('path'));
    }

    /**
     * @return array
     */
    private function data(): array {
      if (!is_file($this->filePath)) {
        throw new \InvalidArgumentException('Configuration file does not exists: ' . $this->filePath);
      }
      $result = parse_ini_file($this->filePath);
      if (!is_array($result)) {
        throw new \RuntimeException('Can not parse file:' . $this->filePath);
      }
      return (array) $result;
    }


    /**
     * @param string $name
     * @return string
     */
    public final function read(string $name): string {
      $data = $this->data();
      if (!array_key_exists($name, $data)) {
        throw new \InvalidArgumentException('Invalid key:' . $name);
      }
      return (string) $data[$name];
    }


  }
