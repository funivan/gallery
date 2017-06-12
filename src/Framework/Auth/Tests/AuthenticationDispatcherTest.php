<?php

  namespace Funivan\Gallery\Framework\Auth\Tests;

  use Funivan\Gallery\Framework\Auth\AuthenticationDispatcher;
  use Funivan\Gallery\Framework\Auth\Tests\Fixtures\DummyAuthComponent;
  use Funivan\Gallery\Framework\Auth\Tests\Fixtures\DummyUser;
  use Funivan\Gallery\Framework\Dispatcher\StaticDispatcher;
  use Funivan\Gallery\Framework\Http\Request\Cookie\RequestCookies;
  use Funivan\Gallery\Framework\Http\Request\Parameters;
  use Funivan\Gallery\Framework\Http\Request\Request;
  use Funivan\Gallery\Framework\Http\Response\Redirect\RedirectResponse;
  use Funivan\Gallery\Framework\Router\PathRoute\PathUrl;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  class AuthenticationDispatcherTest extends TestCase {

    public function testDispatch() {
      $dispatcher = new AuthenticationDispatcher(
        new DummyAuthComponent(new DummyUser(DummyUser::ANONYMOUS)),
        new StaticDispatcher(new RedirectResponse(new PathUrl('/login', new Parameters([])), 302)),
        new StaticDispatcher(
          new RedirectResponse(new PathUrl('/my/login.page', new Parameters([])), 302)
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
        '/login',
        $dispatcher->handle($request)->headers()->field('Location')->value()
      );
    }
  }
