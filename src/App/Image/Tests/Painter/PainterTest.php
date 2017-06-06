<?php

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
      $file = File::create(new LocalPath('/image.png'), new MemoryStorage());
      (new Painter($file))->paint(new CanvasPaintTool(500, 400));
      $file->read();
      $output = (new ImageManager(['driver' => 'gd']))
        ->make($file->read());
      static::assertEquals([500, 400], [$output->getWidth(), $output->getHeight()]);
    }

  }
