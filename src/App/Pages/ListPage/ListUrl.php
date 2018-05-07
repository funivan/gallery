<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Pages\ListPage;

  use Funivan\Gallery\FileStorage\PathInterface;
  use Funivan\Gallery\Framework\Http\Request\Parameters;
  use Funivan\Gallery\Framework\Router\RegexRoute\RegexRouteBuilder;
  use Funivan\Gallery\Framework\Router\UrlInterface;

  /**
   *
   */
  class ListUrl implements UrlInterface {

    public const REGEX = '/list(?<dir>/.*)';

    /**
     * @var UrlInterface
     */
    private $builder;


    /**
     * @todo take a look: Not code free constructor
     * @param PathInterface $path
     */
    public function __construct(PathInterface $path) {
      $this->builder = new RegexRouteBuilder(self::REGEX, new Parameters(['dir' => $path->assemble()]));
    }


    /**
     * @return string
     */
    final public function build(): string {
      return $this->builder->build();
    }

  }