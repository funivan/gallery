<?php
  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Http\Tests\Response\Body;

  use Funivan\CabbageFramework\DataStructures\Stack\StringStack;
  use Funivan\CabbageFramework\Http\Response\Body\BufferedBody;
  use Funivan\CabbageFramework\Http\Response\Plain\PlainBody;
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
