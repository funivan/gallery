<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Pages\IndexPage;

  use Funivan\Gallery\Framework\Dispatcher\DispatcherInterface;
  use Funivan\Gallery\Framework\Http\Request\RequestInterface;
  use Funivan\Gallery\Framework\Http\Response\ResponseInterface;
  use Funivan\Gallery\Framework\Http\Response\ViewResponse\ViewResponse;
  use Funivan\Gallery\Framework\Templating\CompositeView;
  use Funivan\Gallery\Framework\Templating\View;

  /**
   *
   */
  class IndexController implements DispatcherInterface {

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public final function handle(RequestInterface $request): ResponseInterface {
      return new ViewResponse(
        CompositeView::create(__DIR__ . '/../../Layout/viewLayout.php', ['title' => 'Hello'])
          ->withSubView(
            View::create(__DIR__ . '/viewIndex.php', [])
          )
      );
    }

  }