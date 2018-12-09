<?php
  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Auth\Tests;

  use Funivan\CabbageFramework\Auth\AuthenticationDispatcher;
  use Funivan\CabbageFramework\Auth\Tests\Fixtures\DummyAuthComponent;
  use Funivan\CabbageFramework\Auth\Tests\Fixtures\DummyUser;
  use Funivan\CabbageFramework\Dispatcher\StaticDispatcher;
  use Funivan\CabbageFramework\Http\Request\Cookie\RequestCookies;
  use Funivan\CabbageFramework\Http\Request\Parameters;
  use Funivan\CabbageFramework\Http\Request\Request;
  use Funivan\CabbageFramework\Http\Response\Redirect\RedirectResponse;
  use Funivan\CabbageFramework\Router\PathRoute\PathUrl;
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
