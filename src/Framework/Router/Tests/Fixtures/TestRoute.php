<?php


  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Router\Tests\Fixtures;

  use Funivan\Gallery\Framework\Http\Request\RequestInterface;
  use Funivan\Gallery\Framework\Http\Response\ResponseInterface;
  use Funivan\Gallery\Framework\Router\Match\MatchResultInterface;
  use Funivan\Gallery\Framework\Router\RouteInterface;

  /**
   * @codeCoverageIgnore
   */
  class TestRoute implements RouteInterface {

    /**
     * @var MatchResultInterface
     */
    private $matchResult;

    /**
     * @var ResponseInterface
     */
    private $response;


    /**
     * @param MatchResultInterface $result
     * @param ResponseInterface $response
     */
    public function __construct(MatchResultInterface $result, ResponseInterface $response) {
      $this->matchResult = $result;
      $this->response = $response;
    }


    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function handle(RequestInterface $request): ResponseInterface {
      return $this->response;
    }


    /**
     * @param RequestInterface $request
     * @return MatchResultInterface
     */
    public function match(RequestInterface $request): MatchResultInterface {
      return $this->matchResult;
    }
  }