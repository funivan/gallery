<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Image\Tests\Fixtures;

  use Funivan\Gallery\App\Image\Painter\Tool\PainterToolInterface;
  use Intervention\Image\Image;
  use Intervention\Image\ImageManager;

  /**
   * @codeCoverageIgnore
   */
  class CanvasPaintTool implements PainterToolInterface {

    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;


    /**
     * @param int $width
     * @param int $height
     */
    public function __construct(int $width, int $height) {
      $this->width = $width;
      $this->height = $height;
    }


    /**
     * @param ImageManager $imageManager
     * @return Image
     */
    public function paint(ImageManager $imageManager): Image {
      return $imageManager->canvas($this->width, $this->height)
        ->encode('png');
    }

  }