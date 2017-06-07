<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Router\Match\Result;

  use Funivan\Gallery\Framework\Http\Request\ParametersInterface;

  /**
   *
   */
  interface MatchResultInterface {

    /**
     * @return bool
     */
    public function matched(): bool;


    /**
     * @return ParametersInterface
     */
    public function parameters(): ParametersInterface;


  }