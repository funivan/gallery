<?php

  namespace Funivan\Gallery\App\Image\Painter;

  use Funivan\Gallery\FileStorage\File\FileInterface;

  /**
   *
   */
  class PreviewPainter implements PainterInterface {

    /**
     * @param FileInterface $source
     * @param FileInterface $destination
     */
    public function paint(FileInterface $source, FileInterface $destination) {
      $manager = new \Intervention\Image\ImageManager(['driver' => 'imagick']);
      $img = $manager->make($source->read());
      $destination->write(
        (string) $img->fit(300, 300)->encode($source->meta('extension'))
      );
    }

  }
