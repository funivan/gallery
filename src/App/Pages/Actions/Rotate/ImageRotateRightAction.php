<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Pages\Actions\Rotate;

  use Funivan\Gallery\App\Canvas\Canvas;
  use Funivan\Gallery\App\Canvas\CanvasInterface;
  use Funivan\Gallery\App\Canvas\Painter\PreviewPainter;
  use Funivan\Gallery\App\Canvas\Painter\RotatePainter;
  use Funivan\Gallery\App\Pages\Actions\ImageActionInterface;
  use Funivan\Gallery\FileStorage\FileStorageInterface;

  /**
   *
   */
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
     * Rotate image and build new preview
     *
     * @param CanvasInterface $photo
     * @return void
     */
    public function execute(CanvasInterface $photo) {
      $photo->paint(new RotatePainter($this->angel, $photo));
      Canvas::createPreview($photo, $this->previewStorage)->paint(new PreviewPainter($photo));
    }

  }
