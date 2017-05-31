<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Pages\Actions;

  use Funivan\Gallery\App\Canvas\CanvasInterface;

  /**
   *
   */
  interface ImageActionInterface {


    /**
     * @param CanvasInterface $photo
     * @return void
     */
    public function execute(CanvasInterface $photo) : void;


  }