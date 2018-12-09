<?php
  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Http\Tests\Response\Cookie;

  use Funivan\CabbageFramework\Http\Response\Cookie\ResponseCookie;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  final class ResponseCookieTest extends TestCase {

    public function testSimple(): void {
      $cookie = ResponseCookie::create('test', 'user');
      self::assertSame('test=user;', $cookie->assemble());
    }


    public function testWithParts(): void {
      $cookie = ResponseCookie::createWithParts('test', 'user', [ResponseCookie::HTTP_ONLY]);
      self::assertSame('test=user;HttpOnly', $cookie->assemble());
    }


    public function testExpires(): void {
      $time = new \DateTime();
      $cookie = ResponseCookie::createExpires('TestCustomUserName', 'muValue', $time, []);
      self::assertSame('TestCustomUserName=muValue;expires=' . gmdate('D, d-M-Y H:i:s T', $time->getTimestamp()), $cookie->assemble());
    }


  }
