<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Http\Request;

  /**
   *
   */
  interface ParametersInterface {

    /**
     * @param ParametersInterface $parameters
     * @return ParametersInterface
     */
    public function merge(ParametersInterface $parameters): ParametersInterface;


    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool;


    /**
     * @param string $name
     * @return string
     */
    public function value(string $name): string;


    /**
     * @return array Array<String, String>
     */
    public function all(): array;

  }