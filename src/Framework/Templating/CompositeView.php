<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\Framework\Templating;

  use Funivan\Gallery\Framework\Templating\Exception\OverwriteViewVariableException;

  /**
   *
   * Render sub view and provide content to the base view
   * Important!
   * Variable $content is reserved in the main view
   */
  class CompositeView implements ViewInterface {

    /**
     * @var string
     */
    private $id;

    /**
     * @var array
     */
    private $data;

    /**
     * @var ViewInterface
     */
    private $subView;


    /**
     * @param string $id
     * @param array $data
     * @param ViewInterface $subView
     */
    public function __construct(string $id, array $data, ViewInterface $subView) {
      $this->id = $id;
      $this->data = $data;
      $this->subView = $subView;
    }


    /**
     * @return string
     * @throws OverwriteViewVariableException
     */
    public final function render(): string {
      if (array_key_exists('content', $this->data)) {
        throw new OverwriteViewVariableException(
          sprintf('Base view should not contains "%s" data', 'content')
        );
      }
      $data = array_merge($this->data, ['content' => $this->subView->render()]);
      ob_start();
      extract($data, EXTR_SKIP);
      /** @noinspection PhpIncludeInspection */
      include $this->id;
      return ob_get_clean();
    }

  }