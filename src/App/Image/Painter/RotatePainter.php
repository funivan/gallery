<?php
  declare(strict_types=1);

  namespace Funivan\Gallery\App\Image\Painter;

  use Funivan\Gallery\FileStorage\File\FileInterface;

  class RotatePainter implements PainterInterface {

    /**
     * @var int
     */
    private $angel;


    /**
     * @param int $angel
     */
    public function __construct(int $angel) {
      $this->angel = $angel;
    }


    public function paint(FileInterface $file): FileInterface {
      if ($this->angel < 0 or $this->angel > 360) {
        throw new \InvalidArgumentException('Invalid angel. Should be between 0...360');
      }
      $manager = new \Intervention\Image\ImageManager(['driver' => 'imagick']);
      $img = $manager->make($file->read());
      $file->write(
        (string) $img->rotate($this->angel)->encode($file->meta('extension'))
      );
      return $file;
    }

  }
