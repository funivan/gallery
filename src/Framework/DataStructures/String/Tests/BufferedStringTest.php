<?php

  namespace Funivan\Gallery\Framework\DataStructures\String\Tests;

  use Funivan\Gallery\Framework\DataStructures\String\BufferedString;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  final class BufferedStringTest extends TestCase {

    public function testEmptyOnInitialization() {
      self::assertTrue((new BufferedString())->empty());
    }


    public function testAppend() {
      self::assertFalse(
        (new BufferedString())
          ->append('1')
          ->append('2')
          ->empty()
      );
    }

  }
