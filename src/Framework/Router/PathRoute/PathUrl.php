<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Router\PathRoute;

  use Funivan\Gallery\Framework\Http\Request\ParametersInterface;
  use Funivan\Gallery\Framework\Router\UrlInterface;

  /**
   *
   */
  class PathUrl implements UrlInterface {

    /**
     * @var string
     */
    private $path;

    /**
     * @var ParametersInterface
     */
    private $parameters;


    /**
     * @param string $path
     * @param ParametersInterface $parameters
     */
    public function __construct(string $path, ParametersInterface $parameters) {
      $this->path = $path;
      $this->parameters = $parameters;
    }


    /**
     * Create url from the parameters
     *
     * @return string
     */
    final public function build(): string {
      $path = $this->path;
      $parameters = $this->parameters->all();
      if (count($parameters) > 0) {
        $path = $path . '?' . http_build_query($parameters);
      }
      return $path;
    }
  }