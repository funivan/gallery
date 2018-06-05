<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Pages\DeleteQueue;

  use Funivan\Gallery\Framework\Router\UrlInterface;

  class ShowDeleteQueueUrl implements UrlInterface {

    public const URL = '/delete/queue';


    /**
     * @return string
     */
    public function build(): string {
      return self::URL;
    }
  }