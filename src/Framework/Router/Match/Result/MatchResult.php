<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Router\Match\Result;

  use Funivan\Gallery\Framework\Http\Request\Parameters;
  use Funivan\Gallery\Framework\Http\Request\ParametersInterface;

  /**
   *
   */
  class MatchResult implements MatchResultInterface {

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
    private function __construct(bool $matched, ParametersInterface $parameters) {
      $this->matched = $matched;
      $this->parameters = $parameters;
    }


    /**
     * @param bool $matched
     * @param ParametersInterface $parameters
     * @return MatchResultInterface
     */
    public static function create(bool $matched, ParametersInterface $parameters): MatchResultInterface {
      return new self($matched, $parameters);
    }


    /**
     * @return MatchResultInterface
     */
    public static function createSuccess(): MatchResultInterface {
      return new self(true, new Parameters([]));
    }


    /**
     * @return MatchResultInterface
     */
    public static function createFailure(): MatchResultInterface {
      return new self(false, new Parameters([]));
    }


    /**
     * @return bool
     */
    final public function matched(): bool {
      return $this->matched;
    }


    /**
     * @return ParametersInterface
     */
    final public function parameters(): ParametersInterface {
      return $this->parameters;
    }

  }