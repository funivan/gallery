<?php

  namespace Funivan\Gallery\App\Image\Painter;

  use Funivan\Gallery\App\Image\ThumbUid;
  use Funivan\Gallery\FileStorage\File\File;
  use Funivan\Gallery\FileStorage\File\FileInterface;
  use Funivan\Gallery\FileStorage\FileStorageInterface;

  class PreviewPainter implements PainterInterface {

    /**
     * @var FileStorageInterface
     */
    private $previewStorage;


    /**
     * @param FileStorageInterface $previewStorage
     */
    public function __construct(FileStorageInterface $previewStorage) {
      $this->previewStorage = $previewStorage;
    }


    public function paint(FileInterface $file): FileInterface {
      $thumbUid = new ThumbUid($file);
      $preview = File::create($thumbUid->path(), $this->previewStorage);
      $manager = new \Intervention\Image\ImageManager(['driver' => 'imagick']);
      $img = $manager->make($file->read());
      $preview->write(
        (string) $img->fit(300, 300)->encode(
          $preview->meta('extension')
        )
      );
      return $preview;
    }

  }
