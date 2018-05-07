<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Router\Match\Result;

  use Funivan\Gallery\Framework\Http\Request\Parameters;
  use Funivan\Gallery\Framework\Http\Request\ParametersInterface;

  class FailedMatchResult implements MatchResultInterface {

    /**
     * @return bool
     */
    public function matched(): bool {
      return false;
    }


    /**
     * @return ParametersInterface
     */
    public function parameters(): ParametersInterface {
      return new Parameters([]);
    }
  }