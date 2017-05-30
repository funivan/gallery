<?php

  namespace Funivan\Gallery\App\Canvas\Painter;

  use Funivan\Gallery\App\Canvas\CanvasInterface;

  /**
   *
   */
  class PreviewPainter implements PainterInterface {

    /**
     * @var CanvasInterface
     */
    private $image;


    /**
     * @param CanvasInterface $image
     */
    public function __construct(CanvasInterface $image) {
      $this->image = $image;
    }


    /**
     * @return \Intervention\Image\Image
     */
    public function paint(): \Intervention\Image\Image {
      $manager = new \Intervention\Image\ImageManager(['driver' => 'imagick']);
      $img = $manager->make($this->image->file()->read());
      return $img->fit(300, 300);
    }

  }
