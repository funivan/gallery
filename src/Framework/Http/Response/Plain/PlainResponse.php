<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Http\Response\Plain;

  use Funivan\Gallery\Framework\Http\Response\Body\BodyInterface;
  use Funivan\Gallery\Framework\Http\Response\Headers\Headers;
  use Funivan\Gallery\Framework\Http\Response\HeadersInterface;
  use Funivan\Gallery\Framework\Http\Response\ResponseInterface;
  use Funivan\Gallery\Framework\Http\Response\Status\ResponseStatus;
  use Funivan\Gallery\Framework\Http\Response\StatusInterface;

  /**
   *
   */
  class PlainResponse implements ResponseInterface {

    /**
     * @var string
     */
    private $content;

    /**
     * @var HeadersInterface
     */
    private $headers;


    /**
     * @param string $content
     * @param HeadersInterface $headers
     */
    private function __construct(string $content, HeadersInterface $headers) {
      $this->content = $content;
      $this->headers = $headers;
    }


    /**
     * @param string $content
     * @return PlainResponse
     */
    public static function create(string $content): PlainResponse {
      return new self($content, new Headers([]));
    }


    /**
     * @param string $content
     * @param HeadersInterface $headers
     * @return PlainResponse
     */
    public static function createWithHeaders(string $content, HeadersInterface $headers): PlainResponse {
      return new self($content, $headers);
    }


    /**
     * @return StatusInterface
     */
    public final function status(): StatusInterface {
      return new ResponseStatus(200);
    }


    /**
     * @return HeadersInterface
     */
    public final function headers(): HeadersInterface {
      return $this->headers;
    }


    /**
     * @return BodyInterface
     */
    public final function body(): BodyInterface {
      return new PlainBody($this->content);
    }

  }