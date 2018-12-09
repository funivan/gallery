<?php
  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Dispatcher\Tests;

  use Funivan\CabbageFramework\Dispatcher\App;
  use Funivan\CabbageFramework\Dispatcher\StaticDispatcher;
  use Funivan\CabbageFramework\Http\Request\Cookie\RequestCookies;
  use Funivan\CabbageFramework\Http\Request\Parameters;
  use Funivan\CabbageFramework\Http\Request\Request;
  use Funivan\CabbageFramework\Http\Response\Headers\Field;
  use Funivan\CabbageFramework\Http\Response\Headers\Headers;
  use Funivan\CabbageFramework\Http\Response\Plain\PlainResponse;
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
