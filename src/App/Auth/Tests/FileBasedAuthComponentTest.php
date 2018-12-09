<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Auth\Tests;

  use Funivan\Gallery\App\Auth\FileBasedAuthComponent;
  use Funivan\Gallery\App\Auth\UserUidDispatcher;
  use Funivan\Gallery\App\Users\User;
  use Funivan\Gallery\App\Users\UsersInMemory;
  use Funivan\Gallery\FileStorage\Fs\Memory\MemoryStorage;
  use Funivan\CabbageFramework\Http\Request\Cookie\RequestCookie;
  use Funivan\CabbageFramework\Http\Request\Cookie\RequestCookies;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  class FileBasedAuthComponentTest extends TestCase {

    public function testSuccessAuth() {
      $user = new User('123', 'pass', []);
      $auth = new FileBasedAuthComponent(
        RequestCookies::create([new RequestCookie(UserUidDispatcher::COOKIE_UID_NAME, '123')]),
        new MemoryStorage(),
        new UsersInMemory([$user])
      );
      $auth->logIn($user);
      self::assertSame('123', $auth->user()->uid());
    }


    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage User is not authenticated
     */
    public function testRetrieveUnAuthenticatedUser() {
      $auth = new FileBasedAuthComponent(
        RequestCookies::create([new RequestCookie(UserUidDispatcher::COOKIE_UID_NAME, '111')]),
        new MemoryStorage(),
        new UsersInMemory([])
      );
      $auth->user();
    }

  }
