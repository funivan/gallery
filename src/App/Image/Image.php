<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Image;

  use Funivan\Gallery\App\Image\Painter\PainterInterface;
  use Funivan\Gallery\FileStorage\File\File;
  use Funivan\Gallery\FileStorage\File\FileInterface;
  use Funivan\Gallery\FileStorage\FileStorageInterface;
  use Funivan\Gallery\FileStorage\PathInterface;

  /**
   * Represent image in the system.
   *
   */
  class Image implements ImageInterface {

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
     * @return ImageInterface
     */
    public static function createFromRawPath(PathInterface $path, FileStorageInterface $fs): ImageInterface {
      return new self(File::create($path, $fs));
    }


    /**
     * @param ImageInterface $image
     * @param FileStorageInterface $fs
     * @return ImageInterface
     */
    public static function createPreview(ImageInterface $image, FileStorageInterface $fs): ImageInterface {
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
     * @return void
     */
    public function paint(PainterInterface $painter) {
      $result = $painter->paint();
      $this->file->write((string) $result->encode($this->file->meta('extension')));
    }

  }
