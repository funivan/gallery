<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\Framework\Http\Response\Redirect;

  use Funivan\Gallery\Framework\Http\Response\Body\BodyInterface;
  use Funivan\Gallery\Framework\Http\Response\Headers\Field;
  use Funivan\Gallery\Framework\Http\Response\Headers\Headers;
  use Funivan\Gallery\Framework\Http\Response\HeadersInterface;
  use Funivan\Gallery\Framework\Http\Response\Plain\PlainBody;
  use Funivan\Gallery\Framework\Http\Response\ResponseInterface;
  use Funivan\Gallery\Framework\Http\Response\Status\ResponseStatus;
  use Funivan\Gallery\Framework\Http\Response\StatusInterface;
  use Funivan\Gallery\Framework\Router\UrlInterface;

  /**
   *
   */
  class RedirectResponse implements ResponseInterface {

    /**
     * @var UrlInterface
     */
    private $url;

    /**
     * @var int
     */
    private $code;


    /**
     * @param UrlInterface $url
     * @param int $code
     */
    public function __construct(UrlInterface $url, int $code) {
      $this->url = $url;
      $this->code = $code;
    }


    /**
     * @return StatusInterface
     */
    public final function status(): StatusInterface {
      return new ResponseStatus($this->code);
    }


    /**
     * @return HeadersInterface
     */
    public final function headers(): HeadersInterface {
      #@todo create UnCachableHeaders
      return new Headers([
          new Field('Location', $this->url->build()),
          new Field('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0'),
          new Field('Pragma', 'no-cache'),
        ]
      );
    }


    /**
     * @return BodyInterface
     */
    public final function body(): BodyInterface {
      return new PlainBody(
        sprintf(/** @lang text */'Redirect to url: <a href="%1$s">%1$s</a>', $this->url->build())
      );
    }

  }