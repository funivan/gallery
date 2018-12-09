<?php
  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Image\Tests\Painter\Tool;

  use Funivan\Gallery\App\Image\Painter\Tool\PreviewTool;
  use Funivan\CabbageFs\File\File;
  use Intervention\Image\ImageManager;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  class PreviewToolTest extends TestCase {

    public function testSize(): void {
      $imageManager = new ImageManager(['driver' => 'gd']);
      $tool = new PreviewTool(
        File::createInMemory(
          (string) $imageManager
            ->canvas(500, 500)->encode('png')
        )
      );
      $result = $tool->paint($imageManager);
      static::assertEquals([300, 300], [$result->width(), $result->getHeight()]);
    }

  }
