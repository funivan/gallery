<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\Framework\Http\Request\Cookie;

  /**
   *
   */
  class RequestCookies implements RequestCookiesInterface {

    /**
     * @var RequestCookieInterface[] Array<String, RequestCookieInterface>
     */
    private $cookies;


    /**
     * @todo take a look: Not code free constructor
     *
     * @param RequestCookieInterface[] $cookies
     */
    private function __construct(array $cookies = []) {
      $cookiesByName = [];
      foreach ($cookies as $cookie) {
        $cookiesByName[$cookie->name()] = $cookie;
      }
      $this->cookies = $cookiesByName;
    }


    /**
     * @param RequestCookieInterface[] $cookies
     * @return RequestCookiesInterface
     */
    public static function create(array $cookies): RequestCookiesInterface {
      return new self($cookies);
    }


    /**
     * @param array $rawCookies
     * @return RequestCookiesInterface
     */
    public static function createFromRaw(array $rawCookies): RequestCookiesInterface {
      $cookies = [];
      foreach ($rawCookies as $name => $value) {
        $cookies[] = new RequestCookie($name, $value);
      }
      return new self($cookies);
    }


    /**
     * @param string $name
     * @return bool
     */
    public final function has(string $name): bool {
      return array_key_exists($name, $this->cookies);
    }


    /**
     * @param string $name
     * @return RequestCookieInterface
     */
    public final function get(string $name): RequestCookieInterface {
      if (!array_key_exists($name, $this->cookies)) {
        throw new \InvalidArgumentException(sprintf('Can not retrieve cookie %s', $name));
      }
      return $this->cookies[$name];
    }

  }