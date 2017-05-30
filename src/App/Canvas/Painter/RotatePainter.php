<?php
  declare(strict_types=1);

  namespace Funivan\Gallery\App\Canvas\Painter;

  use Funivan\Gallery\App\Canvas\CanvasInterface;

  /**
   *
   */
  class RotatePainter implements PainterInterface {

    /**
     * @var int
     */
    private $angel;

    /**
     * @var CanvasInterface
     */
    private $image;


    /**
     * @param int $angel
     * @param CanvasInterface $image
     */
    public function __construct(int $angel, CanvasInterface $image) {
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
      $img = $manager->make($this->image->file()->read());
      return $img->rotate($this->angel);
    }

  }
