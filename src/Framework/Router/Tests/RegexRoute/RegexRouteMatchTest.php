<?php

  namespace Funivan\Gallery\Framework\Router\Tests\RegexRoute;

  use Funivan\Gallery\Framework\Http\Request\Cookie\RequestCookies;
  use Funivan\Gallery\Framework\Http\Request\Parameters;
  use Funivan\Gallery\Framework\Http\Request\Request;
  use Funivan\Gallery\Framework\Router\RegexRoute\RegexRouteMatch;
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
