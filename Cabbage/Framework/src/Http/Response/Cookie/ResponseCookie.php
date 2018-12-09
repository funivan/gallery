<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Http\Response\Cookie;

  /**
   *
   */
  class ResponseCookie implements ResponseCookieInterface {

    public const HTTP_ONLY = 'HttpOnly';

    public const SECURE = 'Secure';

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $value;


    /**
     * @var array
     */
    private $parts;


    /**
     * @param string $name
     * @param string $value
     * @param string[] $parts
     */
    private function __construct(string $name, string $value, array $parts) {
      $this->name = $name;
      $this->value = $value;
      $this->parts = $parts;
    }


    /**
     * @param string $name
     * @param string $value
     * @return ResponseCookie
     */
    public static function create(string $name, string $value): ResponseCookie {
      return new self($name, $value, []);
    }


    /**
     * @param string $name
     * @param string $value
     * @param array $parts
     * @return ResponseCookie
     */
    public static function createWithParts(string $name, string $value, array $parts): ResponseCookie {
      return new self($name, $value, $parts);
    }


    /**
     * @todo take a look: Not code free constructor
     *
     * @param string $name
     * @param string $value
     * @param \DateTimeInterface $dateTime
     * @param array $parts
     * @return ResponseCookie
     */
    public static function createExpires(string $name, string $value, \DateTimeInterface $dateTime, array $parts): ResponseCookie {
      $parts[] = 'expires=' . gmdate('D, d-M-Y H:i:s T', $dateTime->getTimestamp());
      return new self($name, $value, $parts);
    }


    /**
     * @return string
     */
    final public function assemble(): string {
      return $this->name . '=' . $this->value . ';' . implode(';', $this->parts);
    }

  }