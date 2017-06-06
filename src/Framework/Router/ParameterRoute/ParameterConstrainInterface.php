<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Router\ParameterRoute;

  use Funivan\Gallery\Framework\Http\Request\ParametersInterface;

  /**
   *
   */
  interface ParameterConstrainInterface {

    /**
     * @param ParametersInterface $parameters
     * @return bool
     */
    public function validate(ParametersInterface $parameters): bool;


    /**
     * @return string
     */
    public function name(): string;

  }
