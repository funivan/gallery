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
        $storage->type($path)
      );
    }


    public function testRemove(): void {
      $storage = new MemoryStorage();
      $path = new LocalPath('custom/file my /path/doc.txt');
      $storage->write($path, 'plain content');
      self::assertSame(
        FileStorageInterface::TYPE_FILE,
        $storage->type($path)
      );
      $storage->remove($path);
      self::assertSame(
        FileStorageInterface::TYPE_UNKNOWN,
        $storage->type($path)
      );
    }


    public function testMoveNewFileExists(): void {
      $storage = new MemoryStorage();
      $storage->write(new LocalPath('/path/doc.txt'), 'plain content');
      $storage->move(new LocalPath('/path/doc.txt'), new LocalPath('/path/test.txt'));
      self::assertSame(
        FileStorageInterface::TYPE_FILE,
        $storage->type(new LocalPath('/path/test.txt'))
      );
    }


    public function testList(): void {
      $storage = new MemoryStorage();
      $storage->write(new LocalPath('/my/doc/doc.txt'), 'custom file content');
      $storage->write(new LocalPath('/my/doc/user/data.json'), 'other file content');
      $storage->write(new LocalPath('/my/document.doc'), 'doc content');

      self::assertSame(
        2,
        iterator_count($storage->finder(new LocalPath('/my/doc'))->items())
      );
    }


  }
