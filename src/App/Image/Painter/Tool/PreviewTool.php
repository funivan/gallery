<?php
  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Image\Painter\Tool;

  use Funivan\CabbageFs\File\FileInterface;
  use Intervention\Image\Image;
  use Intervention\Image\ImageManager;

  /**
   *
   */
  class PreviewTool implements PainterToolInterface {

    /**
     * @var FileInterface
     */
    private $image;


    /**
     * @param FileInterface $image
     */
    public function __construct(FileInterface $image) {
      $this->image = $image;
    }


    /**
     * @param ImageManager $imageManager
     * @return Image
     */
    final public function paint(ImageManager $imageManager): Image {
      return $imageManager->make($this->image->read())
        ->fit(300, 300);
    }

  }
