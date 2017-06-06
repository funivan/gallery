<?php
  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Image\Painter\Tool;

  use Funivan\Gallery\FileStorage\File\FileInterface;
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
     * @return \Intervention\Image\Image
     */
    public function paint(): \Intervention\Image\Image {
      if ($this->angel < 0 or $this->angel > 360) {
        throw new \InvalidArgumentException('Invalid angel. Should be between 0...360');
      }
      $manager = new ImageManager(['driver' => 'gd']);
      $img = $manager->make($this->file->read());
      return $img->rotate($this->angel * -1);
    }

  }
