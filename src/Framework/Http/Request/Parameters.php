<?php

  declare(strict_types=1);

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


    /**
     * @param string $name
     * @return bool
     */
    public final function has(string $name): bool {
      return array_key_exists($name, $this->data);
    }


    /**
     * @param string $name
     * @return string
     */
    public final function value(string $name): string {
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
    public final function merge(ParametersInterface $parameters): ParametersInterface {
      return new Parameters(array_merge($this->all(), $parameters->all()));
    }


    /**
     * @return array
     */
    public final function all(): array {
      return $this->data;
    }

  }