<?php
  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Image\Tests\Painter;

  use Funivan\Gallery\App\Image\Painter\Painter;
  use Funivan\Gallery\App\Image\Tests\Fixtures\CanvasPaintTool;
  use Funivan\Gallery\FileStorage\File\File;
  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;
  use Funivan\Gallery\FileStorage\Fs\Memory\MemoryStorage;
  use Intervention\Image\ImageManager;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  class PainterTest extends TestCase {

    public function testWriteDestination() {
      $imageManager = new ImageManager(['driver' => 'gd']);
      $file = File::create(new LocalPath('/image.png'), new MemoryStorage());
      (new Painter($imageManager, $file))->paint(new CanvasPaintTool(500, 400));
      $file->read();
      $output = $imageManager->make($file->read());
      static::assertEquals([500, 400], [$output->width(), $output->height()]);
    }

  }
