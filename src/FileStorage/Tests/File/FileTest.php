<?php
  declare(strict_types = 1);

  namespace Funivan\Gallery\FileStorage\Tests\File;

  use Funivan\Gallery\FileStorage\File\File;
  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;
  use Funivan\Gallery\FileStorage\Fs\Memory\MemoryStorage;
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
