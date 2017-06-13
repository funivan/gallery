<?php
  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Router\Tests\Match;

  use Funivan\Gallery\Framework\Http\Request\Cookie\RequestCookies;
  use Funivan\Gallery\Framework\Http\Request\Parameters;
  use Funivan\Gallery\Framework\Http\Request\Request;
  use Funivan\Gallery\Framework\Router\Match\Result\MatchResult;
  use Funivan\Gallery\Framework\Router\Match\StaticRouteMatch;
  use PHPUnit\Framework\TestCase;

  class StaticRouteMatchTest extends TestCase {


    public function testMatch() {
      $request = new Request(
        new Parameters([]),
        new Parameters([]),
        new Parameters([]),
        new Parameters([]),
        RequestCookies::create([])
      );
      self::assertTrue(
        (new StaticRouteMatch(MatchResult::create(true, new Parameters([]))))
          ->match($request)->matched()
      );
    }
  }
