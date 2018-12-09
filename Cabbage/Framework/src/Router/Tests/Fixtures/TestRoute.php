<?php


  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Router\Tests\Fixtures;

  use Funivan\CabbageFramework\Http\Request\RequestInterface;
  use Funivan\CabbageFramework\Http\Response\ResponseInterface;
  use Funivan\CabbageFramework\Router\Match\Result\MatchResultInterface;
  use Funivan\CabbageFramework\Router\RouteInterface;

  /**
   * @codeCoverageIgnore
   */
  class TestRoute implements RouteInterface {

    /**
     * @var \Funivan\CabbageFramework\Router\Match\Result\MatchResultInterface
     */
    private $matchResult;

    /**
     * @var ResponseInterface
     */
    private $response;


    /**
     * @param \Funivan\CabbageFramework\Router\Match\Result\MatchResultInterface $result
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
     * @return \Funivan\CabbageFramework\Router\Match\Result\MatchResultInterface
     */
    public function match(RequestInterface $request): MatchResultInterface {
      return $this->matchResult;
    }
  }