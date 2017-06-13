<?php
  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Dispatcher\Tests;

  use Funivan\Gallery\Framework\Dispatcher\App;
  use Funivan\Gallery\Framework\Dispatcher\StaticDispatcher;
  use Funivan\Gallery\Framework\Http\Request\Cookie\RequestCookies;
  use Funivan\Gallery\Framework\Http\Request\Parameters;
  use Funivan\Gallery\Framework\Http\Request\Request;
  use Funivan\Gallery\Framework\Http\Response\Headers\Field;
  use Funivan\Gallery\Framework\Http\Response\Headers\Headers;
  use Funivan\Gallery\Framework\Http\Response\Plain\PlainResponse;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  final class AppTest extends TestCase {

    /**
     * @runInSeparateProcess
     */
    public function testSendResponse(): void {
      $app = new App(
        new StaticDispatcher(
          PlainResponse::createWithHeaders(
            'custom body text',
            new Headers([new Field('X-User-Time', '1489')]))
        )
      );
      $request = new Request(
        new Parameters([]),
        new Parameters([]),
        new Parameters([]),
        new Parameters([]),
        RequestCookies::create([])
      );
      ob_start();
      $app->run($request);
      $body = ob_get_clean();
      self::assertSame('custom body text', $body);
      self::assertSame(['X-User-Time: 1489'], xdebug_get_headers());
    }

  }
