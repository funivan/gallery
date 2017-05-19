<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\FileStorage\Tests\Fs\Local;

  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  final class LocalPathTest extends TestCase {

    public function testPrevious() {
      self::assertSame(
        '/home/ivan',
        (new LocalPath('/home/ivan/test'))->previous()->assemble()
      );
    }


    public function testPreviousAsRoot() {
      self::assertSame(
        '/',
        (new LocalPath('/home'))->previous()->assemble()
      );
    }


    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Can not retrieve previous path. LocalPath is root already
     */
    public function testPreviousFromRoot() {
      (new LocalPath('/'))->previous();
    }


    public function testAssembled() {
      self::assertSame(
        '/home/ivan/user name',
        (new LocalPath('/home/ivan/user name'))->assemble()
      );
    }


    public function testInvalid() {
      $path = new LocalPath('/home/ivan/user name');
      self::assertSame('/home/ivan/user name', $path->assemble());
    }


    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Path is invalid. Should not be ended with: /
     */
    public function testInvalidUrl() {
      (new LocalPath('/nice/'))->assemble();
    }


    public function testEqual() {
      self::assertTrue(
        (new LocalPath('/test/usr'))->equal(
          (new LocalPath('/test'))->next(new LocalPath('/usr'))
        )
      );
    }


    public function testNotEqual() {
      self::assertFalse(
        (new LocalPath('/test/usr'))->equal(
          new LocalPath('/test/usb')
        )
      );
    }


    public function testName() {
      self::assertSame(
        'usr',
        (new LocalPath('/test/usr'))->name()
      );
    }


    public function testRootName() {
      self::assertSame(
        '/',
        (new LocalPath('/'))->name()
      );
    }


    public function testNext() {
      self::assertSame(
        '/test/usr',
        (new LocalPath('/test'))
          ->next(new LocalPath('/usr'))
          ->assemble()
      );
    }


    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Next path can not be root
     */
    public function testNextWithRoot() {
      (new LocalPath('/test'))
        ->next(new LocalPath('/'));
    }


    public function testNextFromRoot() {
      self::assertSame('/test',
        (new LocalPath('/'))
          ->next(new LocalPath('/test'))->assemble()
      );
    }


  }
