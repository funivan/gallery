<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Templating;

  use Funivan\Gallery\Framework\Templating\Exception\OverwriteViewVariableException;

  /**
   * Render sub view and provide content to the base view
   * Important!
   * Variable $content is reserved in the main view
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
     * @var ViewInterface|null
     */
    private $subView;


    /**
     * @param string $id
     * @param array $data
     * @param ViewInterface|null $subView
     */
    private function __construct(string $id, array $data, ?ViewInterface $subView) {
      $this->id = $id;
      $this->data = $data;
      $this->subView = $subView;
    }


    /**
     * @param string $id
     * @param array $data
     * @return ViewInterface
     */
    public static function create(string $id, array $data): ViewInterface {
      return new self($id, $data, null);
    }


    /**
     * @param string $id
     * @param array $data
     * @param ViewInterface $view
     * @return ViewInterface
     */
    public static function createWithView(string $id, array $data, ViewInterface $view): ViewInterface {
      return new self($id, $data, $view);
    }


    /**
     * @param array $data
     * @return ViewInterface
     */
    public final function withData(array $data): ViewInterface {
      return new self($this->id, array_merge($this->data, $data), $this->subView);
    }


    /**
     * @param ViewInterface $view
     * @return ViewInterface
     */
    public final function withSubView(ViewInterface $view): ViewInterface {
      return new self($this->id, $this->data, $view);
    }


    /**
     * @return string
     * @throws OverwriteViewVariableException
     */
    public final function render(): string {
      if (array_key_exists('content', $this->data)) {
        throw new OverwriteViewVariableException(
          sprintf('View should not contains variable "%s"', 'content')
        );
      }
      if (null !== $this->subView) {
        $data = array_merge($this->data, ['content' => $this->subView->render()]);
      } else {
        $data = $this->data;
      }
      ob_start();
      extract($data, EXTR_SKIP);
      /** @noinspection PhpIncludeInspection */
      include $this->id;
      return ob_get_clean();
    }


  }