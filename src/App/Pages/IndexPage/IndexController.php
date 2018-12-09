<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Pages\IndexPage;

  use Funivan\CabbageFramework\Dispatcher\DispatcherInterface;
  use Funivan\CabbageFramework\Http\Request\RequestInterface;
  use Funivan\CabbageFramework\Http\Response\ResponseInterface;
  use Funivan\CabbageFramework\Http\Response\ViewResponse\ViewResponse;
  use Funivan\CabbageFramework\Templating\View;
  use Funivan\CabbageFramework\Templating\ViewInterface;

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