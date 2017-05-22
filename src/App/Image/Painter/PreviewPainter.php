<?php

  namespace Funivan\Gallery\App\Image\Painter;

  use Funivan\Gallery\App\Image\ImageInterface;

  /**
   *
   */
  class PreviewPainter implements PainterInterface {

    /**
     * @var ImageInterface
     */
    private $image;


    /**
     * @param ImageInterface $image
     */
    public function __construct(ImageInterface $image) {
      $this->image = $image;
    }


    /**
     * @return \Intervention\Image\Image
     */
    public function paint(): \Intervention\Image\Image {
      $manager = new \Intervention\Image\ImageManager(['driver' => 'imagick']);
      $img = $manager->make($this->image->original()->read());
      return $img->fit(300, 300);
    }

  }
