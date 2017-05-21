<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Pages\Actions\Rotate;

  use Funivan\Gallery\App\Image\Painter\PreviewPainter;
  use Funivan\Gallery\App\Image\Painter\RotatePainter;
  use Funivan\Gallery\App\Pages\Actions\ImageActionInterface;
  use Funivan\Gallery\FileStorage\File\FileInterface;
  use Funivan\Gallery\FileStorage\FileStorageInterface;

  class ImageRotateRightAction implements ImageActionInterface {

    /**
     * @var int
     */
    private $angel;

    /**
     * @var FileStorageInterface
     */
    private $previewStorage;


    /**
     * @param int $angel
     * @param FileStorageInterface $previewStorage
     */
    public function __construct(int $angel, FileStorageInterface $previewStorage) {
      $this->previewStorage = $previewStorage;
      $this->angel = $angel;
    }


    /**
     * Rotate image and build new
     *
     * @param FileInterface $image
     * @return void
     */
    public function execute(FileInterface $image) {
      (new PreviewPainter($this->previewStorage))->paint(
        (new RotatePainter($this->angel))->paint($image)
      );
    }

  }
