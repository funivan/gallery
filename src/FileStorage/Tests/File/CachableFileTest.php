<?php

  namespace Funivan\Gallery\FileStorage\Fs\File;

  use Funivan\Gallery\FileStorage\File\CachableFile;
  use Funivan\Gallery\FileStorage\File\File;
  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;
  use Funivan\Gallery\FileStorage\Fs\Memory\MemoryStorage;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  final class CachableFileTest extends TestCase {

    public function testRead() {
      $storage = new MemoryStorage();
      $path = new LocalPath('custom.txt');
      $storage->write($path, 'first content');
      self::assertSame('first content', (new CachableFile(
        File::create($path, $storage)
      ))->read());
    }


    public function testCache() {
      $storage = new MemoryStorage();
      $path = new LocalPath('custom.txt');
      $file = new CachableFile(
        File::create($path, $storage)
      );
      $storage->write($path, 'first content');
      $file->read();
      $storage->write($path, 'Second content');
      self::assertSame('first content', $file->read());
    }


    public function testRemove() {
      $storage = new MemoryStorage();
      $filePath = new LocalPath('custom.txt');
      $storage->write($filePath, 'first content');
      $file = new CachableFile(File::create($filePath, $storage));
      $file->remove();
      self::assertFalse($file->exists());
    }


    public function testWrite() {
      $original = File::createInMemory();
      $file = new CachableFile($original);
      $file->write("first");
      $original->write("second");
      self::assertSame('first', $file->read());
    }

  }
