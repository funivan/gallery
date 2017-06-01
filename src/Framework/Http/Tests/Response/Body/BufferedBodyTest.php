<?php

  namespace Funivan\Gallery\Framework\Http\Tests\Response\Body;

  use Funivan\Gallery\Framework\DataStructures\Stack\StringStack;
  use Funivan\Gallery\Framework\Http\Response\Body\BufferedBody;
  use Funivan\Gallery\Framework\Http\Response\Plain\PlainBody;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  final class BufferedBodyTest extends TestCase {

    public function testOutputToStackOnly(): void {
      $stack = new StringStack();
      ob_start();
      (new BufferedBody(new PlainBody('user'), $stack))->send();
      $result = ob_get_clean();
      self::assertSame('', $result);
      self::assertFalse($stack->empty());
    }
  }
