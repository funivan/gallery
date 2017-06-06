<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\FileStorage\Tests\Fs\Local;

  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  final class LocalPathTest extends TestCase {

    public function testPrevious(): void {
      self::assertSame(
        '/home/ivan',
        (new LocalPath('/home/ivan/test'))->previous()->assemble()
      );
    }


    public function testPreviousAsRoot(): void {
      self::assertSame(
        '/',
        (new LocalPath('/home'))->previous()->assemble()
      );
    }


    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Can not retrieve previous path. LocalPath is root already
     */
    public function testPreviousFromRoot(): void {
      (new LocalPath('/'))->previous();
    }


    public function testAssembled(): void {
      self::assertSame(
        '/home/ivan/user name',
        (new LocalPath('/home/ivan/user name'))->assemble()
      );
    }


    public function testInvalid(): void {
      $path = new LocalPath('/home/ivan/user name');
      self::assertSame('/home/ivan/user name', $path->assemble());
    }


    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Path is invalid. Should not be ended with: /
     */
    public function testInvalidUrl(): void {
      (new LocalPath('/nice/'))->assemble();
    }


    public function testEqual(): void {
      self::assertTrue(
        (new LocalPath('/test/usr'))->equal(
          (new LocalPath('/test'))->next(new LocalPath('/usr'))
        )
      );
    }


    public function testNotEqual(): void {
      self::assertFalse(
        (new LocalPath('/test/usr'))->equal(
          new LocalPath('/test/usb')
        )
      );
    }


    public function testName(): void {
      self::assertSame(
        'usr',
        (new LocalPath('/test/usr'))->name()
      );
    }


    public function testRootName(): void {
      self::assertSame(
        '/',
        (new LocalPath('/'))->name()
      );
    }


    public function testNext(): void {
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
    public function testNextWithRoot(): void {
      (new LocalPath('/test'))
        ->next(new LocalPath('/'));
    }


    public function testNextFromRoot(): void {
      self::assertSame('/test',
        (new LocalPath('/'))
          ->next(new LocalPath('/test'))->assemble()
      );
    }


  }
