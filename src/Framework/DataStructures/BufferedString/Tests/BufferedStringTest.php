<?php
  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\DataStructures\BufferedString\Tests;

  use Funivan\Gallery\Framework\DataStructures\BufferedString\BufferedString;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  final class BufferedStringTest extends TestCase {

    public function testEmptyOnInitialization(): void {
      self::assertTrue((new BufferedString())->empty());
    }


    public function testAppend(): void {
      self::assertFalse(
        (new BufferedString())
          ->append('1')
          ->append('2')
          ->empty()
      );
    }

  }
