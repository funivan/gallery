<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Http\Request;

  use Funivan\CabbageFramework\Http\Request\Cookie\RequestCookiesInterface;


  /**
   *
   */
  interface RequestInterface {


    /**
     * Represent input GET parameters
     *
     * @return ParametersInterface
     */
    public function get(): ParametersInterface;


    /**
     * Represent SERVER parameters
     *
     * @return ParametersInterface
     */
    public function server(): ParametersInterface;


    /**
     * Represent input POST parameters
     *
     * @return ParametersInterface
     */
    public function post(): ParametersInterface;


    /**
     * Represent custom user parameters. Can be
     *
     * @return ParametersInterface
     */
    public function parameters(): ParametersInterface;


    /**
     * @return RequestCookiesInterface
     */
    public function cookies(): RequestCookiesInterface;


    /**
     * @param ParametersInterface $parameters
     * @return RequestInterface
     */
    public function withParameters(ParametersInterface $parameters): RequestInterface;

  }