<?php
  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Dispatcher\Tests;

  use Funivan\Gallery\Framework\Dispatcher\App;
  use Funivan\Gallery\Framework\Dispatcher\DispatcherInterface;
  use Funivan\Gallery\Framework\Http\Request\Cookie\RequestCookies;
  use Funivan\Gallery\Framework\Http\Request\Parameters;
  use Funivan\Gallery\Framework\Http\Request\Request;
  use Funivan\Gallery\Framework\Http\Request\RequestInterface;
  use Funivan\Gallery\Framework\Http\Response\Body\BodyInterface;
  use Funivan\Gallery\Framework\Http\Response\Headers\Field;
  use Funivan\Gallery\Framework\Http\Response\Headers\Headers;
  use Funivan\Gallery\Framework\Http\Response\HeadersInterface;
  use Funivan\Gallery\Framework\Http\Response\Plain\PlainBody;
  use Funivan\Gallery\Framework\Http\Response\ResponseInterface;
  use Funivan\Gallery\Framework\Http\Response\Status\ResponseStatus;
  use Funivan\Gallery\Framework\Http\Response\StatusInterface;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  final class AppTest extends TestCase {

    /**
     * @runInSeparateProcess
     */
    public function testSendResponse(): void {
      $dispatcher = new class implements DispatcherInterface {

        public function handle(RequestInterface $request): ResponseInterface {
          return new class implements ResponseInterface {

            public function status(): StatusInterface {
              return new ResponseStatus(200);
            }


            public function headers(): HeadersInterface {
              return new Headers([new Field('X-User-Time', '1489')]);
            }


            public function body(): BodyInterface {
              return new PlainBody('custom body text');
            }
          };
        }
      };

      $parameters = new Parameters([]);
      $app = new App($dispatcher);
      $request = new Request($parameters, $parameters, $parameters, $parameters, RequestCookies::create([]));

      ob_start();
      $app->run($request);
      $body = ob_get_clean();
      self::assertSame('custom body text', $body);
      self::assertSame(['X-User-Time: 1489'], xdebug_get_headers());
    }

  }
