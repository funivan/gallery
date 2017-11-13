<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Pages\IndexPage;

  use Funivan\Gallery\Framework\Dispatcher\DispatcherInterface;
  use Funivan\Gallery\Framework\Http\Request\RequestInterface;
  use Funivan\Gallery\Framework\Http\Response\ResponseInterface;
  use Funivan\Gallery\Framework\Http\Response\ViewResponse\ViewResponse;
  use Funivan\Gallery\Framework\Templating\View;
  use Funivan\Gallery\Framework\Templating\ViewInterface;

  /**
   *
   */
  class IndexController implements DispatcherInterface {

    /**
     * @var ViewInterface
     */
    private $view;


    /**
     * @param ViewInterface $view
     */
    public function __construct(ViewInterface $view) {
      $this->view = $view;
    }


    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    final public function handle(RequestInterface $request): ResponseInterface {
      return new ViewResponse(
        $this->view->withData(['title' => 'index page'])
          ->withSubView(
            View::create(__DIR__ . '/viewIndex.php', [])
          )
      );
    }

  }