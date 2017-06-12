<?php

  namespace Funivan\Gallery\Framework\Auth\Tests;

  use Funivan\Gallery\Framework\Auth\AuthorizationDispatcher;
  use Funivan\Gallery\Framework\Auth\Tests\Fixtures\DummyAuthComponent;
  use Funivan\Gallery\Framework\Auth\Tests\Fixtures\DummyUser;
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
  class AuthorizationDispatcherTest extends TestCase {


    public function testHasAccess() {
      $authorization = new AuthorizationDispatcher(
        'edit_photo',
        new DummyAuthComponent(
          new DummyUser(123, '123', ['edit_photo'])
        ),
        new StaticDispatcher(
          PlainResponse::createWithHeaders(
            'authorized',
            new Headers([
              new Field('Location', '/authorized/zone'),
            ])
          )
        )
      );

      $request = new Request(
        new Parameters([]),
        new Parameters([]),
        new Parameters([]),
        new Parameters([]),
        RequestCookies::create([])
      );
      self::assertSame(
        '/authorized/zone',
        $authorization->handle($request)->headers()->field('Location')->value()
      );

    }
  }
