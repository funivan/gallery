<?php

  namespace Funivan\Gallery\Framework\DataStructures\Stack\Tests;

  use Funivan\Gallery\Framework\DataStructures\Stack\StringStack;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  final class StringStackTest extends TestCase {

    public function testEmpty() {
      $stack = new StringStack();
      self::assertTrue($stack->empty());
      $stack->push('123');
      self::assertFalse($stack->empty());
    }


    public function testPop() {
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
    public function testPopEnd() {
      $stack = new StringStack();
      $stack->push('1');
      self::assertSame('1', $stack->pop());
      $stack->pop();
    }


  }
