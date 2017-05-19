<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\Framework\Http\Response\ViewResponse;

  use Funivan\Gallery\Framework\Http\Response\Body\BodyInterface;
  use Funivan\Gallery\Framework\Templating\ViewInterface;

  /**
   *
   */
  class ViewBody implements BodyInterface {

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
     * Send content to the output
     *
     * @return void
     */
    public final function send() {
      echo $this->view->render();
    }

  }