<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Pages\Auth\LoginPage\Form;

  /**
   * @todo take a look: Data transfer object
   */
  class ValidationResult {

    /**
     * @var string[]
     */
    private $errors;


    /**
     * @param string[] $errors
     */
    public function __construct(array $errors) {
      $this->errors = $errors;
    }


    /**
     * @return bool
     */
    final public function valid(): bool {
      return count($this->errors) === 0;
    }


    /**
     * @return string[]
     */
    final public function errors(): array {
      return $this->errors;
    }

  }