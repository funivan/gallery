<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Http\Response\ViewResponse;

  use Funivan\CabbageFramework\Http\Response\Body\BodyInterface;
  use Funivan\CabbageFramework\Http\Response\Headers\Headers;
  use Funivan\CabbageFramework\Http\Response\HeadersInterface;
  use Funivan\CabbageFramework\Http\Response\ResponseInterface;
  use Funivan\CabbageFramework\Http\Response\Status\ResponseStatus;
  use Funivan\CabbageFramework\Http\Response\StatusInterface;
  use Funivan\CabbageFramework\Templating\ViewInterface;

  /**
   *
   */
  class ViewResponse implements ResponseInterface {

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
     * @return StatusInterface
     */
    final public function status(): StatusInterface {
      return new ResponseStatus(200);
    }


    /**
     * @return HeadersInterface
     */
    final public function headers(): HeadersInterface {
      return new Headers([]);
    }


    /**
     * @return \Funivan\CabbageFramework\Http\Response\Body\BodyInterface
     */
    final public function body(): BodyInterface {
      return new ViewBody($this->view);
    }

  }