<?php
  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Image\Painter\Tool;

  use Funivan\CabbageFs\File\FileInterface;
  use Intervention\Image\Image;
  use Intervention\Image\ImageManager;

  /**
   *
   */
  class RotateTool implements PainterToolInterface {

    /**
     * @var int
     */
    private $angel;

    /**
     * @var FileInterface
     */
    private $file;


    /**
     * @param int $angel The rotation angle in degrees to rotate the image clockwise.
     * @param FileInterface $file
     */
    public function __construct(int $angel, FileInterface $file) {
      $this->angel = $angel;
      $this->file = $file;
    }


    /**
     * @param ImageManager $imageManager
     * @return Image
     */
    final public function paint(ImageManager $imageManager): Image {
      if ($this->angel < 0 or $this->angel > 360) {
        throw new \InvalidArgumentException('Invalid angel. Should be between 0...360');
      }
      return $imageManager->make($this->file->read())
        ->rotate($this->angel * -1);
    }

  }
