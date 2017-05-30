<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Photo;

  use Funivan\Gallery\FileStorage\File\FileInterface;
  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;
  use Funivan\Gallery\Framework\DataStructures\ParsedString\ParsedString;

  /**
   *
   */
  class MetaInformation {

    const FAVOURITE = 'f';

    const PRIVATE = 'p';

    const DELETED = 'd';

    private const FLAGS = [
      self::FAVOURITE,
      self::PRIVATE,
      self::DELETED,
    ];

    /**
     * @var PhotoInterface
     */
    private $file;


    /**
     * @param FileInterface $photo
     */
    public function __construct(FileInterface $photo) {
      $this->file = $photo;
      $this->regex = '!^(?<name>.+)(?<f>(--f)|)(?<p>(--p)|)?(?<d>(--d)|)?(?<extension>\.[a-zA-Z]{3,4})$!uU';
    }


    public function set(string $type): FileInterface {
      $path = $this->file->path();
      $this->file->move(
        $path->previous()->next(
          new LocalPath(
            (new ParsedString($path->name(), $this->regex))
              ->with($type, '--' . $type)
              ->value()
          )
        )
      );
    }


    public function remove(string $type): void {
      $path = $this->file->path();
      $this->file->move(
        $path->previous()->next(
          new LocalPath(
            (new ParsedString($path->name(), $this->regex))
              ->with($type)
              ->value()
          )
        )
      );
    }


    public function has(string $type): bool {
      return (new ParsedString($this->file->path()->name(), $this->regex))->has($type);
    }


  }