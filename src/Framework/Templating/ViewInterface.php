<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Templating;


  /**
   * Plain view interface
   */
  interface ViewInterface {

    /**
     * @param array $data
     * @return ViewInterface
     */
    public function withData(array $data): ViewInterface;

    /**
     * @param ViewInterface $view
     * @return ViewInterface
     */
    public function withSubView(ViewInterface $view): ViewInterface;


    /**
     * @return string
     */
    public function render(): string;

  }