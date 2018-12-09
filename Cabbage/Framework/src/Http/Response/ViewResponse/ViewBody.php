<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Http\Response\ViewResponse;

  use Funivan\CabbageFramework\Http\Response\Body\BodyInterface;
  use Funivan\CabbageFramework\Templating\ViewInterface;

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
    final public function send(): void {
      echo $this->view->render();
    }

  }