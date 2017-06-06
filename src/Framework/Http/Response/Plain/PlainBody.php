<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Http\Response\Plain;

  use Funivan\Gallery\Framework\Http\Response\Body\BodyInterface;

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
    public final function send(): void {
      echo $this->content;
    }


  }