<?php
  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Auth\Tests;

  use Funivan\Gallery\App\Auth\UserUidDispatcher;
  use Funivan\Gallery\Framework\Dispatcher\DispatcherInterface;
  use Funivan\Gallery\Framework\Http\Request\Cookie\RequestCookie;
  use Funivan\Gallery\Framework\Http\Request\Cookie\RequestCookies;
  use Funivan\Gallery\Framework\Http\Request\Cookie\RequestCookiesInterface;
  use Funivan\Gallery\Framework\Http\Request\Parameters;
  use Funivan\Gallery\Framework\Http\Request\Request;
  use Funivan\Gallery\Framework\Http\Request\RequestInterface;
  use Funivan\Gallery\Framework\Http\Response\Plain\PlainResponse;
  use Funivan\Gallery\Framework\Http\Response\ResponseInterface;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  final class UserUidDispatcherTest extends TestCase {


    public function testWithoutUidGeneration(): void {
      $request = $this->createRequest(
        RequestCookies::create([new RequestCookie(UserUidDispatcher::COOKIE_UID_NAME, '123')])
      );
      $response = (new UserUidDispatcher($this->createNextDummyDispatcher()))->handle($request);

      self::assertCount(0, $response->headers()->fields());
    }


    public function testWitUidGeneration(): void {
      $request = $this->createRequest(RequestCookies::create([]));
      $response = (new UserUidDispatcher($this->createNextDummyDispatcher()))->handle($request);

      $headerFields = $response->headers()->fields();
      self::assertCount(1, $headerFields);
      self::assertSame('Set-Cookie', $headerFields[0]->name());
      self::assertStringStartsWith(UserUidDispatcher::COOKIE_UID_NAME . '=', $headerFields[0]->value());
    }


    /**
     * @param \Funivan\Gallery\Framework\Http\Request\Cookie\RequestCookiesInterface $cookies
     * @return RequestInterface
     */
    private function createRequest(RequestCookiesInterface $cookies): RequestInterface {
      return new Request(
        new Parameters([]),
        new Parameters([]),
        new Parameters([]),
        new Parameters([]),
        $cookies
      );
    }


    /**
     * @return DispatcherInterface
     */
    private function createNextDummyDispatcher(): DispatcherInterface {
      $next = new class implements DispatcherInterface {

        public function handle(RequestInterface $request): ResponseInterface {
          return PlainResponse::create('test');
        }
      };
      return $next;
    }

  }
