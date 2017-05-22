<?php
  declare(strict_types=1);

  namespace Funivan\Gallery\App\Image\Painter;

  use Funivan\Gallery\App\Image\ImageInterface;

  /**
   *
   */
  class RotatePainter implements PainterInterface {

    /**
     * @var int
     */
    private $angel;

    /**
     * @var ImageInterface
     */
    private $image;


    /**
     * @param int $angel
     * @param ImageInterface $image
     */
    public function __construct(int $angel, ImageInterface $image) {
      $this->angel = $angel;
      $this->image = $image;
    }


    /**
     * @return \Intervention\Image\Image
     */
    public function paint(): \Intervention\Image\Image {
      if ($this->angel < 0 or $this->angel > 360) {
        throw new \InvalidArgumentException('Invalid angel. Should be between 0...360');
      }
      $manager = new \Intervention\Image\ImageManager(['driver' => 'imagick']);
      $img = $manager->make($this->image->original()->read());
      return $img->rotate($this->angel);
    }

  }
