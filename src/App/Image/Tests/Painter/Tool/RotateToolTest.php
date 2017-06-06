<?php

  namespace Funivan\Gallery\App\Image\Tests\Painter\Tool;

  use Funivan\Gallery\App\Image\Painter\Tool\RotateTool;
  use Funivan\Gallery\FileStorage\File\File;
  use Intervention\Image\ImageManager;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  class RotateToolTest extends TestCase {

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid angel. Should be between 0...360
     */
    public function testInvalidAngel() {
      (new RotateTool(361, File::createInMemory()))->paint();
    }


    public function testSize(): void {
      $tool = new RotateTool(90,
        File::createInMemory(
          (string) (new ImageManager(['driver' => 'gd']))
            ->canvas(4, 4)
            ->fill('#000')
            ->pixel('#ffffff', 0, 0)
            ->encode('png')
        )
      );
      static::assertEquals(
        '#ffffff',
        $tool->paint()->pickColor(3, 0, 'hex')
      );
    }

  }
