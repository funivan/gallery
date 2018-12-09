<?php
  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\DataStructures\Stack\Tests;

  use Funivan\CabbageFramework\DataStructures\Stack\StringStack;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  final class StringStackTest extends TestCase {

    public function testEmpty(): void {
      $stack = new StringStack();
      self::assertTrue($stack->empty());
      $stack->push('123');
      self::assertFalse($stack->empty());
    }


    public function testPop(): void {
      $stack = new StringStack();
      $stack->push('1');
      $stack->push('2');
      self::assertSame('2', $stack->pop());
      self::assertSame('1', $stack->pop());
    }


    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Stack is empty
     */
    public function testPopEnd(): void {
      $stack = new StringStack();
      $stack->push('1');
      self::assertSame('1', $stack->pop());
      $stack->pop();
    }


  }
