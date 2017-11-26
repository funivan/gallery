<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Http\Request;

  /**
   *
   * @todo return parameters from this parameters
   */
  class Parameters implements ParametersInterface {

    /**
     * @var array
     */
    private $data;


    /**
     * @param array $parameters Array<String, String>
     */
    public function __construct(array $parameters) {
      $this->data = $parameters;
    }



    final public function has(string $name): bool {
      return array_key_exists($name, $this->data);
    }


    /**
     * @param string $name
     * @return string
     */
    final public function value(string $name): string {
      if (!array_key_exists($name, $this->data)) {
        throw new \InvalidArgumentException(
          sprintf('Can not fetch parameter: %s', $name)
        );
      }
      return (string) $this->data[$name];
    }


    /**
     * @param ParametersInterface $parameters
     * @return ParametersInterface
     */
    final public function merge(ParametersInterface $parameters): ParametersInterface {
      return new Parameters(array_merge($this->all(), $parameters->all()));
    }


    /**
     * @return array Array<String, String>
     */
    final public function all(): array {
      return $this->data;
    }

  }