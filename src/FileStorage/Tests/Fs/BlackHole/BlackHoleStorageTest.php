<?php

  namespace Funivan\Gallery\FileStorage\Tests\Fs\BlackHole;

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
      self::assertFalse($storage->file($path));
    }


    public function testDirectory(): void {
      $path = new LocalPath('/test');
      self::assertFalse((new BlackHoleStorage())->directory($path));
    }


  }
