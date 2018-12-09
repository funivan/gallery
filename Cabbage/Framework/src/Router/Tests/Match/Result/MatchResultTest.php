<?php
  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Router\Tests\Match\Result;

  use Funivan\CabbageFramework\Router\Match\Result\MatchResult;
  use PHPUnit\Framework\TestCase;

  class MatchResultTest extends TestCase {

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
