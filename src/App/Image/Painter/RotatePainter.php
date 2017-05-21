<?php
  declare(strict_types=1);

  namespace Funivan\Gallery\App\Image\Painter;

  use Funivan\Gallery\FileStorage\File\FileInterface;

  /**
   *
   */
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


    /**
     * @param FileInterface $source
     * @param FileInterface $destination
     * @return FileInterface
     */
    public function paint(FileInterface $source, FileInterface $destination) {
      if ($this->angel < 0 or $this->angel > 360) {
        throw new \InvalidArgumentException('Invalid angel. Should be between 0...360');
      }
      $manager = new \Intervention\Image\ImageManager(['driver' => 'imagick']);
      $img = $manager->make($source->read());
      $destination->write(
        (string) $img->rotate($this->angel)->encode($source->meta('extension'))
      );
      return $source;
    }

  }
