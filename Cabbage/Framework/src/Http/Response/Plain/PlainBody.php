<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Http\Response\Plain;

  use Funivan\CabbageFramework\Http\Response\Body\BodyInterface;

  /**
   *
   */
  class PlainBody implements BodyInterface {

    /**
     * @var string
     */
    private $content;


    /**
     * @param string $content
     */
    public function __construct(string $content) {
      $this->content = $content;
    }


    /**
     * @return void
     */
    final public function send(): void {
      echo $this->content;
    }


  }