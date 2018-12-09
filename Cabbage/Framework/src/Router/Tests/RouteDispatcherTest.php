<?php
  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Router\Tests;

  use Funivan\CabbageFramework\DataStructures\Stack\StringStack;
  use Funivan\CabbageFramework\Dispatcher\DispatcherInterface;
  use Funivan\CabbageFramework\Http\Request\Cookie\RequestCookies;
  use Funivan\CabbageFramework\Http\Request\Parameters;
  use Funivan\CabbageFramework\Http\Request\Request;
  use Funivan\CabbageFramework\Http\Request\RequestInterface;
  use Funivan\CabbageFramework\Http\Response\Body\BufferedBody;
  use Funivan\CabbageFramework\Http\Response\Plain\PlainResponse;
  use Funivan\CabbageFramework\Http\Response\ResponseInterface;
  use Funivan\CabbageFramework\Router\Match\Result\MatchResult;
  use Funivan\CabbageFramework\Router\Match\Result\MatchResultInterface;
  use Funivan\CabbageFramework\Router\Match\RouteMatchInterface;
  use Funivan\CabbageFramework\Router\Route;
  use Funivan\CabbageFramework\Router\RouterDispatcher;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  final class RouteDispatcherTest extends TestCase {

    public function testPassCustomParametersOnMatch(): void {
      $routeMatch = new class implements RouteMatchInterface {

        public function match(RequestInterface $request): MatchResultInterface {
          return MatchResult::create(true, new Parameters(['id' => $request->get()->value('formId')]));
        }
      };
      $dispatcher = new class implements DispatcherInterface {

        public function handle(RequestInterface $request): ResponseInterface {
          return PlainResponse::create(
            sprintf('Form Submitted: %s', $request->parameters()->value('id'))
          );
        }
      };

      $routeDispatcher = new RouterDispatcher([new Route($routeMatch, $dispatcher)]);
      $response = $routeDispatcher->handle(
        new Request(
          new Parameters(['formId' => '123']),
          new Parameters([]),
          new Parameters([]),
          new Parameters([]),
          RequestCookies::create([])
        )
      );

      $stack = new StringStack();
      (new BufferedBody($response->body(), $stack))->send();
      self::assertSame('Form Submitted: 123', $stack->pop());
    }
  }
