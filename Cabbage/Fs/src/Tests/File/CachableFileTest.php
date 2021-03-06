<?php
  declare(strict_types = 1);

  namespace Funivan\CabbageFs\Fs\File;

  use Funivan\CabbageFs\File\CachableFile;
  use Funivan\CabbageFs\File\File;
  use Funivan\CabbageFs\FileStorageInterface;
  use Funivan\CabbageFs\Fs\Local\LocalPath;
  use Funivan\CabbageFs\Fs\Memory\MemoryStorage;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  final class CachableFileTest extends TestCase {

    public function testRead(): void {
      $storage = new MemoryStorage();
      $path = new LocalPath('custom.txt');
      $storage->write($path, 'first content');
      self::assertSame('first content', (new CachableFile(
        File::create($path, $storage)
      ))->read());
    }


    public function testCache(): void {
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


    public function testRemove(): void {
      $storage = new MemoryStorage();
      $filePath = new LocalPath('custom.txt');
      $storage->write($filePath, 'first content');
      $file = new CachableFile(File::create($filePath, $storage));
      $file->remove();
      self::assertFalse($file->exists());
    }


    public function testWrite(): void {
      $original = File::createInMemory();
      $file = new CachableFile($original);
      $file->write('first');
      $original->write('second');
      self::assertSame('first', $file->read());
    }


    public function testForwardMeta() {
      self::assertSame(
        'json',
        (new CachableFile(
          File::create(new LocalPath('/test.json'), new MemoryStorage())
        ))->meta('extension')
      );
    }


    public function testForwardPath() {
      self::assertSame(
        '/my/custom/user.txt',
        (new CachableFile(
          File::create(new LocalPath('/my/custom/user.txt'), new MemoryStorage())
        ))->path()->assemble()
      );
    }


    public function testMove() {
      $storage = new MemoryStorage();
      $file = new CachableFile(
        File::create(new LocalPath('/data.json'), $storage)
      );
      $file->write('test');
      $file->move(new LocalPath('/data/text.json'));
      self::assertSame(
        FileStorageInterface::TYPE_FILE,
        $storage->type(new LocalPath('/data/text.json'))
      );
    }

  }
