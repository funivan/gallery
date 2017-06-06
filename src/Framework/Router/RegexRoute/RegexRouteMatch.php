<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Router\RegexRoute;

  use Funivan\Gallery\Framework\Http\Request\Parameters;
  use Funivan\Gallery\Framework\Http\Request\RequestInterface;
  use Funivan\Gallery\Framework\Router\Match\EmptyMatchResult;
  use Funivan\Gallery\Framework\Router\Match\MatchResult;
  use Funivan\Gallery\Framework\Router\Match\MatchResultInterface;
  use Funivan\Gallery\Framework\Router\RouteMatchInterface;

  /**
   *
   */
  class RegexRouteMatch implements RouteMatchInterface {

    /**
     * @var string
     */
    private $regex;


    /**
     * @param string $regex
     */
    public function __construct(string $regex) {
      $this->regex = $regex;
    }


    /**
     * @param RequestInterface $request
     * @return MatchResultInterface
     */
    public final function match(RequestInterface $request): MatchResultInterface {
      $matched = (preg_match('!^' . $this->regex . '$!', $request->server()->value('PATH_INFO'), $params) === 1);
      if ($matched) {
        foreach ((array) $params as $index => $param) {
          if (is_numeric($index)) {
            unset($params[$index]);
          }
        }
        $result = new MatchResult(true, new Parameters($params));
      } else {
        $result = new EmptyMatchResult();
      }
      return $result;
    }

  }