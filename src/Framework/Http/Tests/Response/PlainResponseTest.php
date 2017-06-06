<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Http\Tests\Response;

  use Funivan\Gallery\Framework\DataStructures\Stack\StringStack;
  use Funivan\Gallery\Framework\Http\Response\Body\BufferedBody;
  use Funivan\Gallery\Framework\Http\Response\Plain\PlainResponse;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  final class PlainResponseTest extends TestCase {

    public function testContent(): void {
      $plainResponse = PlainResponse::create('Test');
      $buffer = new StringStack();
      (new BufferedBody($plainResponse->body(), $buffer))->send();
      self::assertSame('Test', $buffer->pop());
    }

  }
