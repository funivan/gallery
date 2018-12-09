<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Router\Match\Result;

  use Funivan\CabbageFramework\Http\Request\Parameters;
  use Funivan\CabbageFramework\Http\Request\ParametersInterface;

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