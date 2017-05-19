<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\Framework\Http\Response\ViewResponse;

  use Funivan\Gallery\Framework\Http\Response\Body\BodyInterface;
  use Funivan\Gallery\Framework\Http\Response\Headers\Headers;
  use Funivan\Gallery\Framework\Http\Response\HeadersInterface;
  use Funivan\Gallery\Framework\Http\Response\ResponseInterface;
  use Funivan\Gallery\Framework\Http\Response\Status\ResponseStatus;
  use Funivan\Gallery\Framework\Http\Response\StatusInterface;
  use Funivan\Gallery\Framework\Templating\View;
  use Funivan\Gallery\Framework\Templating\ViewInterface;

  /**
   *
   */
  class ViewResponse implements ResponseInterface {

    /**
     * @var View
     */
    private $view;


    /**
     * @param ViewInterface $view
     */
    public function __construct(ViewInterface $view) {
      $this->view = $view;
    }


    /**
     * @return StatusInterface
     */
    public final function status(): StatusInterface {
      return new ResponseStatus(200);
    }


    /**
     * @return HeadersInterface
     */
    public final function headers(): HeadersInterface {
      return new Headers([]);
    }


    /**
     * @return \Funivan\Gallery\Framework\Http\Response\Body\BodyInterface
     */
    public final function body(): BodyInterface {
      return new ViewBody($this->view);
    }

  }