<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Router\Match\Result;

  use Funivan\CabbageFramework\Http\Request\ParametersInterface;

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