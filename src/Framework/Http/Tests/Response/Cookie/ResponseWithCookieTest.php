<?php

  namespace Funivan\Gallery\Framework\Http\Tests\Response\Cookie;

  use Funivan\Gallery\Framework\Http\Response\Cookie\ResponseCookie;
  use Funivan\Gallery\Framework\Http\Response\Cookie\ResponseWithCookie;
  use Funivan\Gallery\Framework\Http\Response\Plain\PlainResponse;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  final class ResponseWithCookieTest extends TestCase {

    public function testResponseWithCookie(): void {
      $response = new ResponseWithCookie(
        ResponseCookie::createExpires('new_test', 'user2', new \DateTime(), ['path' => '/']),
        new ResponseWithCookie(
          ResponseCookie::create('test', 'user'),
          PlainResponse::create('test')
        )
      );
      $lines = [];
      $fields = $response->headers()->fields();
      foreach ($fields as $field) {
        $lines[] = $field->name() . ':' . $field->value();
      }
      self::assertCount(1, $lines);
      self::assertStringStartsNotWith('Set-Cookie: test=user;new_test=user2;/;expires=', $lines[0]);
    }

  }
