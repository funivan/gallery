<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Http\Request;

  use Funivan\CabbageFramework\Http\Request\Cookie\RequestCookiesInterface;

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
    final public function withParameters(ParametersInterface $parameters): RequestInterface {
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
    final public function get(): ParametersInterface {
      return $this->get;
    }


    /**
     * @return ParametersInterface
     */
    final public function server(): ParametersInterface {
      return $this->server;
    }


    /**
     * @return ParametersInterface
     */
    final public function post(): ParametersInterface {
      return $this->post;
    }


    /**
     * @return ParametersInterface
     */
    final public function parameters(): ParametersInterface {
      return $this->userParameters;
    }


    /**
     * @return RequestCookiesInterface
     */
    final public function cookies(): RequestCookiesInterface {
      return $this->cookies;
    }

  }