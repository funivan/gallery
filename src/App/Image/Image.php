<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Image;

  use Funivan\Gallery\FileStorage\File\File;
  use Funivan\Gallery\FileStorage\File\FileInterface;
  use Funivan\Gallery\FileStorage\FileStorageInterface;
  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;

  /**
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
     * @param string $path
     * @param FileStorageInterface $fs
     * @return Image
     */
    public static function createFromRawPath(string $path, FileStorageInterface $fs): Image {
      return new self(File::create(new LocalPath($path), $fs));
    }


    /**
     * @param FileStorageInterface $storage
     * @return FileInterface
     */
    public function preview(FileStorageInterface $storage): FileInterface {
      $thumbUid = new ThumbUid($this->original());
      return File::create($thumbUid->path(), $storage);
    }


    /**
     * @return FileInterface
     */
    public function original(): FileInterface {
      return $this->file;
    }

  }
