<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Http\Response\Plain;

  use Funivan\CabbageFramework\Http\Response\Body\BodyInterface;
  use Funivan\CabbageFramework\Http\Response\Headers\Headers;
  use Funivan\CabbageFramework\Http\Response\HeadersInterface;
  use Funivan\CabbageFramework\Http\Response\ResponseInterface;
  use Funivan\CabbageFramework\Http\Response\Status\ResponseStatus;
  use Funivan\CabbageFramework\Http\Response\StatusInterface;

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
    final public function status(): StatusInterface {
      return new ResponseStatus(200);
    }


    /**
     * @return HeadersInterface
     */
    final public function headers(): HeadersInterface {
      return $this->headers;
    }


    /**
     * @return BodyInterface
     */
    final public function body(): BodyInterface {
      return new PlainBody($this->content);
    }

  }