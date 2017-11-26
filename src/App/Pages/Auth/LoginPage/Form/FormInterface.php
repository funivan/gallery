<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Pages\Auth\LoginPage\Form;

  use Funivan\Gallery\Framework\Http\Request\RequestInterface;


  /**
   *
   */
  interface FormInterface {

    /**
     * @param RequestInterface $request
     * @return ValidationResult
     */
    public function validate(RequestInterface $request): ValidationResult;


    /**
     * @param RequestInterface $request
     * @return bool
     */
    public function submitted(RequestInterface $request): bool;
  }