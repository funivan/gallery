<?php

  namespace Funivan\Gallery\FileStorage\Tests\Fs\Memory;

  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;
  use Funivan\Gallery\FileStorage\Fs\Memory\MemoryStorage;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  final class MemoryStorageTest extends TestCase {


    public function testRead() {
      $storage = new MemoryStorage();
      $path = new LocalPath('users.txt');
      $storage->write($path, 'plain content');
      self::assertSame('plain content', $storage->read($path));
    }


    public function testObjectsStatus() {
      $storage = new MemoryStorage();
      $path = new LocalPath('/my/document.doc');
      $storage->write($path, 'plain content');
      self::assertTrue($storage->file($path));
    }


    public function testRemove() {
      $storage = new MemoryStorage();
      $path = new LocalPath('custom/file my /path/doc.txt');
      $storage->write($path, 'plain content');
      self::assertTrue($storage->file($path));
      $storage->remove($path);
      self::assertFalse($storage->file($path));
    }


  }
