<?php

  namespace Funivan\Gallery\App\Auth\Tests;

  use Funivan\Gallery\App\Auth\AuthComponent;
  use Funivan\Gallery\App\Users\UsersInMemory;
  use Funivan\Gallery\FileStorage\Fs\Memory\MemoryStorage;
  use Funivan\Gallery\Framework\Http\Request\Cookie\RequestCookies;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  class AuthComponentTest extends TestCase {

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage User is not authenticated
     */
    public function testRetrieveUnAuthenticatedUser() {
      $auth = new AuthComponent(
        RequestCookies::create([]),
        new MemoryStorage(),
        new UsersInMemory([])
      );
      $auth->user();
    }

  }
