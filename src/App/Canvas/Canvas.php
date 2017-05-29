<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Canvas;

  use Funivan\Gallery\App\Canvas\Painter\PainterInterface;
  use Funivan\Gallery\FileStorage\File\File;
  use Funivan\Gallery\FileStorage\File\FileInterface;
  use Funivan\Gallery\FileStorage\FileStorageInterface;
  use Funivan\Gallery\FileStorage\PathInterface;

  /**
   * Represent image in the system.
   *
   */
  class Canvas implements CanvasInterface {

    /**
     * @var FileInterface
     */
    private $file;


    /**
     * @param FileInterface $file
     */
    private function __construct(FileInterface $file) {
      $this->file = $file;
    }


    /**
     * @param PathInterface $path
     * @param FileStorageInterface $fs
     * @return CanvasInterface
     */
    public static function createFromRawPath(PathInterface $path, FileStorageInterface $fs): CanvasInterface {
      return new self(File::create($path, $fs));
    }


    /**
     * @param CanvasInterface $image
     * @param FileStorageInterface $fs
     * @return CanvasInterface
     */
    public static function createPreview(CanvasInterface $image, FileStorageInterface $fs): CanvasInterface {
      return new self(
        File::create(
          (new PreviewLocation($image->original()))->path(),
          $fs
        )
      );
    }


    /**
     * @return FileInterface
     */
    public function original(): FileInterface {
      return $this->file;
    }


    /**
     * @param PainterInterface $painter
     */
    public function paint(PainterInterface $painter): void {
      $result = $painter->paint();
      $this->file->write((string) $result->encode($this->file->meta('extension')));
    }

  }
