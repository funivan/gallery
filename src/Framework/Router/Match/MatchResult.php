<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\Framework\Router\Match;

  use Funivan\Gallery\Framework\Http\Request\ParametersInterface;

  /**
   *
   */
  final class MatchResult implements MatchResultInterface {

    /**
     * @var bool
     */
    private $matched;

    /**
     * @var ParametersInterface
     */
    private $parameters;


    /**
     * @param bool $matched
     * @param ParametersInterface $parameters
     */
    public function __construct(bool $matched, ParametersInterface $parameters) {
      $this->matched = $matched;
      $this->parameters = $parameters;
    }


    /**
     * @return bool
     */
    public function matched(): bool {
      return $this->matched;
    }


    /**
     * @return ParametersInterface
     */
    public function parameters(): ParametersInterface {
      return $this->parameters;
    }

  }