<?php

  namespace Funivan\Gallery\Framework\Http\Tests\Response\Headers;

  use Funivan\Gallery\Framework\Http\Response\Headers\Field;
  use Funivan\Gallery\Framework\Http\Response\Headers\Headers;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  final class HeadersTest extends TestCase {


    public function testMerge() {
      self::assertCount(2,
        (new Headers([new Field('Set-Cookie', 'User=1')]))
          ->merge(new Headers([new Field('Location', "/")]))
          ->fields()
      );
    }


  }
