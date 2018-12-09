<?php
  declare(strict_types = 1);

  namespace Funivan\CabbageFs\Tests\File;

  use Funivan\CabbageFs\File\File;
  use Funivan\CabbageFs\Fs\Local\LocalPath;
  use Funivan\CabbageFs\Fs\Memory\MemoryStorage;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  final class FileTest extends TestCase {

    public function testSuccessfulContentRead(): void {
      $storage = new MemoryStorage();
      $storage->write(new LocalPath('/test/custom/file.txt'), 'file content');
      $file = File::create(new LocalPath('/test/custom/file.txt'), $storage);
      self::assertSame('file content', $file->read());
    }


  }
