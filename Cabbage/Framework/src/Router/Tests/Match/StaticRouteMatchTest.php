<?php
  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Router\Tests\Match;

  use Funivan\CabbageFramework\Http\Request\Cookie\RequestCookies;
  use Funivan\CabbageFramework\Http\Request\Parameters;
  use Funivan\CabbageFramework\Http\Request\Request;
  use Funivan\CabbageFramework\Router\Match\Result\MatchResult;
  use Funivan\CabbageFramework\Router\Match\StaticRouteMatch;
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
