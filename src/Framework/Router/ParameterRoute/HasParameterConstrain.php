<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Router\ParameterRoute;

  use Funivan\Gallery\Framework\Http\Request\ParametersInterface;

  /**
   * Check if Parameters has specific parameter
   * Does not perform value check
   */
  class HasParameterConstrain implements ParameterConstrainInterface {

    /**
     * @var string
     */
    private $name;


    /**
     * @param string $name
     */
    public function __construct(string $name) {
      $this->name = $name;
    }


    /**
     * @param ParametersInterface $parameters
     * @return bool
     */
    public final function validate(ParametersInterface $parameters): bool {
      return $parameters->has($this->name);
    }


    /**
     * @return string
     */
    public final function name(): string {
      return $this->name;
    }


  }