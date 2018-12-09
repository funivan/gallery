<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Router\RegexRoute;

  use Funivan\CabbageFramework\Http\Request\Parameters;
  use Funivan\CabbageFramework\Http\Request\RequestInterface;
  use Funivan\CabbageFramework\Router\Match\Result\FailedMatchResult;
  use Funivan\CabbageFramework\Router\Match\Result\MatchResult;
  use Funivan\CabbageFramework\Router\Match\Result\MatchResultInterface;
  use Funivan\CabbageFramework\Router\Match\RouteMatchInterface;

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
    final public function match(RequestInterface $request): MatchResultInterface {
      $matched = (preg_match('!^' . $this->regex . '$!', $request->server()->value('PATH_INFO'), $params) === 1);
      if ($matched) {
        foreach ((array) $params as $index => $param) {
          if (is_numeric($index)) {
            unset($params[$index]);
          }
        }
        $result = MatchResult::create(true, new Parameters($params));
      } else {
        $result = new FailedMatchResult();
      }
      return $result;
    }

  }