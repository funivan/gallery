<?php

  namespace Funivan\Gallery\Framework\DataStructures\ParsedString\Tests;

  use Funivan\Gallery\Framework\DataStructures\ParsedString\ParsedString;
  use PHPUnit\Framework\TestCase;

  class ParsedStringTest extends TestCase {

    public function testHas() {
      self::assertTrue(
        (new ParsedString('id = 43', '!= (?<id>\d+)!'))->has('id')
      );
    }


    public function testDoesNotHas() {
      self::assertFalse(
        (new ParsedString('user', '!(?<name>[a-z]+)(?<end>[;]*)!'))->has('end')
      );
    }


    public function testDoesNot() {
      self::assertFalse(
        (new ParsedString('ab-cd', '!(?<first>[a-z]+)-(?<second>\d+)!'))->has('second')
      );
    }


    public function testWith() {
      self::assertSame(
        'name.funivan',
        (new ParsedString('name.test', '!(?<property>[a-z]+)(?<delimiter>\.)(?<value>[a-z]+)!'))
          ->with('value', 'funivan')
          ->value()
      );
    }


    public function testWithout() {
      self::assertSame(
        'my-value',
        (new ParsedString('my-value;', '!(?<property>[a-z-]+)(?<delimiter>[;|,|\.])!'))
          ->without('delimiter')
          ->value()
      );
    }

  }
