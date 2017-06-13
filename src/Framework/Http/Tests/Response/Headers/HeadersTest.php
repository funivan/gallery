<?php
  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Http\Tests\Response\Headers;

  use Funivan\Gallery\Framework\Http\Response\Headers\Field;
  use Funivan\Gallery\Framework\Http\Response\Headers\Headers;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  final class HeadersTest extends TestCase {


    public function testMerge(): void {
      self::assertCount(2,
        (new Headers([new Field('Set-Cookie', 'User=1')]))
          ->merge(new Headers([new Field('Location', '/')]))
          ->fields()
      );
    }


    public function testHasFailure() {
      self::assertFalse((new Headers([]))->has('Set-Cookie'));
    }


    public function testHasSuccess() {
      self::assertTrue((new Headers([new Field('Location', '/')]))->has('Location'));
    }


    public function testGet() {
      self::assertSame('/test.com',
        (new Headers([new Field('Location', '/test.com')]))->field('Location')->value()
      );
    }


    /**
     * @expectedException \Funivan\Gallery\Framework\Http\Response\Headers\Exceptions\OverwriteHeaderFieldException
     * @expectedExceptionMessage Header field Location is already defined
     */
    public function testOverwriteExistingVariable() {
      (new Headers(
        [new Field('Location', 'test.com')])
      )->merge(
        new Headers([new Field('Location', '/')])
      );
    }


  }
