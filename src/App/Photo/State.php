<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Photo;

  /**
   *
   */
  class State implements StateInterface {

    /**
     * @var bool
     */
    private $enabled;


    /**
     * @param bool $enabled
     */
    public function __construct(bool $enabled) {
      $this->enabled = $enabled;
    }


    /**
     * @return bool
     */
    public function enabled(): bool {
      return $this->enabled;
    }



  }