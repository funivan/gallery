<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Photo\Flag;

  use Funivan\CabbageFs\File\FileInterface;
  use Funivan\CabbageFs\Fs\Local\LocalPath;
  use Funivan\CabbageFramework\DataStructures\ParsedString\ParsedString;

  /**
   *
   */
  class Flags implements FlagsInterface {

    private const FLAGS = [
      FlagsInterface::FAVOURITE,
      FlagsInterface::PRIVATE,
      FlagsInterface::DELETED,
    ];

    /**
     * @var FileInterface
     */
    private $file;

    /**
     * @var string
     */
    private $regex;


    /**
     * @param FileInterface $file
     */
    public function __construct(FileInterface $file) {
      $this->file = $file;
      $this->regex = '!^(?<name>.+)(?<f>(--f)|)(?<p>(--p)|)?(?<d>(--d)|)?(?<extension>\.[a-zA-Z]{3,4})$!uU';
    }


    /**
     * @param string $type
     * @return FileInterface
     */
    final public function set(string $type): FileInterface {
      if (!in_array($type, self::FLAGS)) {
        throw new \InvalidArgumentException('Unsupported flag');
      }
      $newName = (new ParsedString($this->file->path()->name(), $this->regex))
        ->with($type, '--' . $type)
        ->value();
      return $this->rename($newName);
    }


    /**
     * @param string $type
     * @return FileInterface
     */
    final public function remove(string $type): FileInterface {
      if (!in_array($type, self::FLAGS)) {
        throw new \InvalidArgumentException('Unsupported flag');
      }
      return $this->rename(
        (new ParsedString($this->file->path()->name(), $this->regex))
          ->without($type)
          ->value()
      );
    }


    /**
     * @param string $type
     * @return bool
     */
    final public function has(string $type): bool {
      if (!in_array($type, self::FLAGS)) {
        throw new \InvalidArgumentException('Unsupported flag');
      }
      return (new ParsedString($this->file->path()->name(), $this->regex))->has($type);
    }


    /**
     * @param string $name
     * @return FileInterface
     */
    private function rename(string $name): FileInterface {
      return $this->file->move(
        $this->file->path()->previous()->next(new LocalPath($name))
      );
    }


  }