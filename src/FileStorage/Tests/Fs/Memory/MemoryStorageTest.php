<?php

  namespace Funivan\Gallery\FileStorage\Tests\Fs\Memory;

  use Funivan\Gallery\FileStorage\FileStorageInterface;
  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;
  use Funivan\Gallery\FileStorage\Fs\Memory\MemoryStorage;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  final class MemoryStorageTest extends TestCase {


    public function testRead(): void {
      $storage = new MemoryStorage();
      $path = new LocalPath('users.txt');
      $storage->write($path, 'plain content');
      self::assertSame('plain content', $storage->read($path));
    }


    public function testObjectsStatus(): void {
      $storage = new MemoryStorage();
      $path = new LocalPath('/my/document.doc');
      $storage->write($path, 'plain content');
      self::assertSame(
        FileStorageInterface::TYPE_FILE,
        $storage->meta($path, 'type')
      );
    }


    public function testRemove(): void {
      $storage = new MemoryStorage();
      $path = new LocalPath('custom/file my /path/doc.txt');
      $storage->write($path, 'plain content');
      self::assertSame(
        FileStorageInterface::TYPE_FILE,
        $storage->meta($path, 'type')
      );
      $storage->remove($path);
      self::assertSame(
        FileStorageInterface::TYPE_UNKNOWN,
        $storage->meta($path, 'type')
      );
    }


    public function testMoveNewFileExists(): void {
      $storage = new MemoryStorage();
      $storage->write(new LocalPath('/path/doc.txt'), 'plain content');
      $storage->move(new LocalPath('/path/doc.txt'), new LocalPath('/path/test.txt'));
      self::assertSame(
        FileStorageInterface::TYPE_FILE,
        $storage->meta(new LocalPath('/path/test.txt'), 'type')
      );
    }


  }
