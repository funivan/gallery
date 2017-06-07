<?php

  namespace Funivan\Gallery\Framework\Router\Tests;

  use Funivan\Gallery\Framework\DataStructures\Stack\StringStack;
  use Funivan\Gallery\Framework\Dispatcher\DispatcherInterface;
  use Funivan\Gallery\Framework\Http\Request\Cookie\RequestCookies;
  use Funivan\Gallery\Framework\Http\Request\Parameters;
  use Funivan\Gallery\Framework\Http\Request\Request;
  use Funivan\Gallery\Framework\Http\Request\RequestInterface;
  use Funivan\Gallery\Framework\Http\Response\Body\BufferedBody;
  use Funivan\Gallery\Framework\Http\Response\Plain\PlainResponse;
  use Funivan\Gallery\Framework\Http\Response\ResponseInterface;
  use Funivan\Gallery\Framework\Router\Match\Result\MatchResult;
  use Funivan\Gallery\Framework\Router\Match\Result\MatchResultInterface;
  use Funivan\Gallery\Framework\Router\Match\RouteMatchInterface;
  use Funivan\Gallery\Framework\Router\Route;
  use Funivan\Gallery\Framework\Router\RouterDispatcher;
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
