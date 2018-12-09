<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Http\Tests\Request\Cookie;

  use Funivan\CabbageFramework\Http\Request\Cookie\RequestCookies;
  use PHPUnit\Framework\TestCase;

  class RequestCookiesTest extends TestCase {

    public function testCreateFromRaw() {
      self::assertSame(
        '123',
        RequestCookies::createFromRaw(['login_uid' => '123'])
          ->get('login_uid')->value()
      );
    }


    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Can not retrieve cookie login
     */
    public function testRetrieveInvalidCookie() {
      RequestCookies::createFromRaw(['name' => 'UserName'])->get('login');
    }

  }
