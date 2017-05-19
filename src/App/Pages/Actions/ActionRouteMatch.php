<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Pages\Actions;

  use Funivan\Gallery\Framework\Http\Request\RequestInterface;
  use Funivan\Gallery\Framework\Router\Match\MatchResultInterface;
  use Funivan\Gallery\Framework\Router\ParameterRoute\ParameterRoutMatch;
  use Funivan\Gallery\Framework\Router\ParameterRoute\SameParameterConstrain;
  use Funivan\Gallery\Framework\Router\RouteMatchInterface;

  /**
   *
   */
  class ActionRouteMatch implements RouteMatchInterface {

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $state;


    /**
     * @param string $type
     * @param string $state
     */
    public function __construct(string $type, string $state) {
      $this->type = $type;
      $this->state = $state;
    }


    /**
     * @param RequestInterface $request
     * @return MatchResultInterface
     */
    public final function match(RequestInterface $request): MatchResultInterface {
      return ParameterRoutMatch::createWithNext(
        'USER', new SameParameterConstrain('type', $this->type),
        ParameterRoutMatch::create(
          'USER', new SameParameterConstrain('state', $this->state)
        )
      )->match($request);
    }

  }