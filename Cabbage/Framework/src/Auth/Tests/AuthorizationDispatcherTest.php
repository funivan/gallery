<?php
  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Auth\Tests;

  use Funivan\CabbageFramework\Auth\AuthorizationDispatcher;
  use Funivan\CabbageFramework\Auth\Tests\Fixtures\DummyAuthComponent;
  use Funivan\CabbageFramework\Auth\Tests\Fixtures\DummyUser;
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
  class AuthorizationDispatcherTest extends TestCase {


    public function testHasAccess() {
      $authorization = new AuthorizationDispatcher(
        'edit_photo',
        new DummyAuthComponent(
          new DummyUser('123', '123', ['edit_photo'])
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
