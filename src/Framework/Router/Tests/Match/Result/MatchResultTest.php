<?php

  namespace Funivan\Gallery\Framework\Router\Tests\Match\Result;

  use Funivan\Gallery\Framework\Router\Match\Result\MatchResult;
  use PHPUnit\Framework\TestCase;

  class MatchResultTest extends TestCase {

    public function testFailureResult() {
      self::assertFalse(MatchResult::createFailure()->matched());
    }


    public function testParametersFailure() {
      self::assertCount(
        0,
        MatchResult::createFailure()->parameters()->all()
      );
    }
    public function testSuccessResult() {
      self::assertTrue(MatchResult::createSuccess()->matched());
    }


    public function testParametersSuccess() {
      self::assertCount(
        0,
        MatchResult::createSuccess()->parameters()->all()
      );
    }
  }
