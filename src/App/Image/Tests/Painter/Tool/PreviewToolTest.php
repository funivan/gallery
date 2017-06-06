<?php

  namespace Funivan\Gallery\App\Image\Tests\Painter\Tool;

  use Funivan\Gallery\App\Image\Painter\Tool\PreviewTool;
  use Funivan\Gallery\FileStorage\File\File;
  use Intervention\Image\ImageManager;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  class PreviewToolTest extends TestCase {

    public function testSize(): void {
      $tool = new PreviewTool(
        File::createInMemory(
          (string) (new ImageManager(['driver' => 'imagick']))
            ->canvas(500, 500)->encode('png')
        )
      );
      $result = $tool->paint();
      static::assertEquals([300, 300,], [$result->getWidth(), $result->getHeight()]);
    }

  }
