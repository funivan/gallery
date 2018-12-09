<?php
  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Router\Tests\RegexRoute;

  use Funivan\CabbageFramework\Http\Request\Cookie\RequestCookies;
  use Funivan\CabbageFramework\Http\Request\Parameters;
  use Funivan\CabbageFramework\Http\Request\Request;
  use Funivan\CabbageFramework\Router\RegexRoute\RegexRouteMatch;
  use PHPUnit\Framework\TestCase;

  class RegexRouteMatchTest extends TestCase {


    public function testMatchSuccess() {
      $request = new Request(
        new Parameters([]),
        new Parameters([]),
        new Parameters([
          'PATH_INFO'=>'/test.php'
        ]),
        new Parameters([]),
        RequestCookies::create([])
      );
      self::assertTrue(
        (new RegexRouteMatch('/test\.php'))->match($request)->matched()
      );
    }
  }
