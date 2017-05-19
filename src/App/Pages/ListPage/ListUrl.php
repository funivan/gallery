<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Pages\ListPage;

  use Funivan\Gallery\FileStorage\PathInterface;
  use Funivan\Gallery\Framework\Http\Request\Parameters;
  use Funivan\Gallery\Framework\Router\RegexRoute\RegexRouteBuilder;

  /**
   *
   */
  final class ListUrl extends RegexRouteBuilder {

    const REGEX = '/list(?<dir>/.*)';


    /**
     * @todo take a look: Not code free constructor
     *
     * @param PathInterface $path
     */
    public function __construct(PathInterface $path) {
      parent::__construct(self::REGEX, new Parameters(['dir' => $path->assemble()]));
    }

  }