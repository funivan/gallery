<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Router\ParameterRoute;

  use Funivan\Gallery\Framework\Http\Request\ParametersInterface;

  /**
   *
   */
  final class SameParameterConstrain implements ParameterConstrainInterface {

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
    public function validate(ParametersInterface $parameters): bool {
      return ($parameters->has($this->name) and $parameters->value($this->name) === $this->value);
    }


    /**
     * @return string
     */
    public function name(): string {
      return $this->name;
    }

  }