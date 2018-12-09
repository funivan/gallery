<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Router\ParameterRoute;

  use Funivan\CabbageFramework\Http\Request\ParametersInterface;

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
