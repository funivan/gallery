<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Auth\Tests;

  use Funivan\Gallery\App\Auth\AuthComponent;
  use Funivan\Gallery\App\Auth\UserUidDispatcher;
  use Funivan\Gallery\App\Users\User;
  use Funivan\Gallery\App\Users\UsersInMemory;
  use Funivan\Gallery\FileStorage\File\File;
  use Funivan\Gallery\FileStorage\Fs\BlackHole\BlackHoleStorage;
  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;
  use Funivan\Gallery\FileStorage\Fs\Memory\MemoryStorage;
  use Funivan\Gallery\Framework\Http\Request\Cookie\RequestCookie;
  use Funivan\Gallery\Framework\Http\Request\Cookie\RequestCookies;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  class AuthComponentTest extends TestCase {


    public function testSuccessAuth() {
      $user = new User('123', 'pass', []);
      $auth = AuthComponent::createFromCookie(
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
      $auth = AuthComponent::create(
        File::create(new LocalPath('/memory.txt'), new BlackHoleStorage()),
        new UsersInMemory([])
      );
      $auth->user();
    }

  }
