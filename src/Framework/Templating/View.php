<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\Framework\Templating;

  /**
   *
   */
  class View implements ViewInterface {

    /**
     * @var string
     */
    private $id;

    /**
     * @var array
     */
    private $data;


    /**
     * @param string $id
     * @param array $data
     */
    public function __construct(string $id, array $data = []) {
      $this->id = $id;
      $this->data = $data;
    }


    /**
     * @return string
     */
    public final function render(): string {
      ob_start();
      extract($this->data, EXTR_SKIP);
      /** @noinspection PhpIncludeInspection */
      include $this->id;
      return ob_get_clean();
    }

  }
