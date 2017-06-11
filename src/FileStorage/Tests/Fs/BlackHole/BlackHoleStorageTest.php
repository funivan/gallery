<?php

  namespace Funivan\Gallery\FileStorage\Tests\Fs\BlackHole;

  use Funivan\Gallery\FileStorage\FileStorageInterface;
  use Funivan\Gallery\FileStorage\FinderFilter;
  use Funivan\Gallery\FileStorage\Fs\BlackHole\BlackHoleStorage;
  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  final class BlackHoleStorageTest extends TestCase {

    public function testDummyWrite(): void {
      $storage = new BlackHoleStorage();
      $path = new LocalPath('/test.txt');
      $storage->write($path, 'data');
      self::assertSame(
        FileStorageInterface::TYPE_UNKNOWN,
        $storage->meta($path, 'type')
      );
    }


    public function testFind(): void {
      self::assertSame(
        [],
        (new BlackHoleStorage())->find(
          new FinderFilter(
            new LocalPath('/'),
            FinderFilter::TYPE_DIR
          )
        )
      );
    }


    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage "Read" operation is not supported by this adapter
     */
    public function testRead() {
      (new BlackHoleStorage())->read(new LocalPath('/document.txt'));
    }


  }
