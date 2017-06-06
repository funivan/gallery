<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Router\Match;

  use Funivan\Gallery\Framework\Http\Request\Parameters;
  use Funivan\Gallery\Framework\Http\Request\ParametersInterface;

  /**
   *
   */
  final class EmptyMatchResult implements MatchResultInterface {

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