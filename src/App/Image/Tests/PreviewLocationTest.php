<?php
  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Image\Tests;

  use Funivan\Gallery\App\Image\PreviewLocation;
  use Funivan\CabbageFs\File\File;
  use Funivan\CabbageFs\Fs\Local\LocalPath;
  use Funivan\CabbageFs\Fs\Memory\MemoryStorage;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  class PreviewLocationTest extends TestCase {


    public function testPathGenerate() {
      self::assertSame(
        'dd/94/dd9468cf4b950c56a767bb73b9dd095d.jpg',
        (new PreviewLocation(
          File::create(new LocalPath('/user/test/index.jpg'), new MemoryStorage())
        ))->path()->assemble()
      );
    }

  }
