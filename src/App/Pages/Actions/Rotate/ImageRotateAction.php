<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Pages\Actions\Rotate;

  use Funivan\Gallery\App\Image\Painter\Painter;
  use Funivan\Gallery\App\Image\Painter\Tool\PreviewTool;
  use Funivan\Gallery\App\Image\Painter\Tool\RotateTool;
  use Funivan\Gallery\App\Image\PreviewLocation;
  use Funivan\Gallery\App\Pages\Actions\ImageActionInterface;
  use Funivan\Gallery\FileStorage\File\File;
  use Funivan\Gallery\FileStorage\File\FileInterface;
  use Funivan\Gallery\FileStorage\FileStorageInterface;

  /**
   *
   */
  final class ImageRotateAction implements ImageActionInterface {

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
     * @param FileInterface $photo
     * @return FileInterface
     */
    public function execute(FileInterface $photo): FileInterface {
      (new Painter(
        $photo
      ))->paint(new RotateTool($this->angel, $photo));
      (new Painter(
        File::create((new PreviewLocation($photo))->path(), $this->previewStorage)
      ))->paint(new PreviewTool($photo));
      return $photo;
    }

  }
