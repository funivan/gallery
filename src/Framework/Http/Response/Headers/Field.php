<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Http\Response\Headers;

  /**
   * @todo take care. Not object, Just data
   */
  class Field implements FieldInterface {

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
     * @return string
     */
    public final function name(): string {
      return $this->name;
    }


    /**
     * @return string
     */
    public final function value(): string {
      return $this->value;
    }

  }