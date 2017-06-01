<?php

  namespace Funivan\Gallery\App\Image\Painter\Tool;

  use Funivan\Gallery\FileStorage\File\FileInterface;

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
     * @return \Intervention\Image\Image
     */
    public function paint(): \Intervention\Image\Image {
      $manager = new \Intervention\Image\ImageManager(['driver' => 'imagick']);
      $img = $manager->make($this->image->read());
      return $img->fit(300, 300);
    }

  }
