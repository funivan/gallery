<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Router\Tests\Match\Result;

  use Funivan\Gallery\Framework\Router\Match\Result\FailedMatchResult;
  use PHPUnit\Framework\TestCase;

  class FailedMatchResultTest extends TestCase {

    public function testFailureResult() {
      self::assertFalse((new FailedMatchResult())->matched());
    }


    public function testParametersFailure() {
      self::assertCount(
        0,
        (new FailedMatchResult())->parameters()->all()
      );
    }

  }
