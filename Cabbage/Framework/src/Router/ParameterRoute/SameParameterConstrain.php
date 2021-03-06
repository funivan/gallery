<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Router\ParameterRoute;

  use Funivan\CabbageFramework\Http\Request\ParametersInterface;

  /**
   *
   */
  class SameParameterConstrain implements ParameterConstrainInterface {

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $value;


    /**
     * @param string $name
     * @param string $value
     */
    public function __construct(string $name, string $value) {
      $this->name = $name;
      $this->value = $value;
    }


    /**
     * @param ParametersInterface $parameters
     * @return bool
     */
    final public function validate(ParametersInterface $parameters): bool {
      return ($parameters->has($this->name) and $parameters->value($this->name) === $this->value);
    }


    /**
     * @return string
     */
    final public function name(): string {
      return $this->name;
    }

  }