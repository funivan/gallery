<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\Framework\Http\Request;

  use Funivan\Gallery\Framework\Http\Request\Cookie\RequestCookiesInterface;

  /**
   *
   */
  class Request implements RequestInterface {

    /**
     * @var ParametersInterface
     */
    private $get;

    /**
     * @var ParametersInterface
     */
    private $post;

    /**
     * @var ParametersInterface
     */
    private $server;

    /**
     * @var ParametersInterface
     */
    private $userParameters;

    /**
     * @var RequestCookiesInterface
     */
    private $cookies;


    /**
     * @param ParametersInterface $get
     * @param ParametersInterface $post
     * @param ParametersInterface $server
     * @param ParametersInterface $userParameters
     * @param RequestCookiesInterface $cookies
     */
    public function __construct(ParametersInterface $get, ParametersInterface $post, ParametersInterface $server, ParametersInterface $userParameters, RequestCookiesInterface $cookies) {
      $this->get = $get;
      $this->post = $post;
      $this->server = $server;
      $this->userParameters = $userParameters;
      $this->cookies = $cookies;
    }


    /**
     * @param ParametersInterface $parameters
     * @return RequestInterface
     */
    public final function withParameters(ParametersInterface $parameters): RequestInterface {
      return new Request(
        $this->get,
        $this->post,
        $this->server,
        $this->userParameters->merge($parameters),
        $this->cookies
      );
    }


    /**
     * @return ParametersInterface
     */
    public final function get(): ParametersInterface {
      return $this->get;
    }


    /**
     * @return ParametersInterface
     */
    public final function server(): ParametersInterface {
      return $this->server;
    }


    /**
     * @return ParametersInterface
     */
    public final function post(): ParametersInterface {
      return $this->post;
    }


    /**
     * @return ParametersInterface
     */
    public final function parameters(): ParametersInterface {
      return $this->userParameters;
    }


    /**
     * @return RequestCookiesInterface
     */
    public final function cookies(): RequestCookiesInterface {
      return $this->cookies;
    }

  }