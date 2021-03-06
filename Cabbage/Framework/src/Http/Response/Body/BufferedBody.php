<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Http\Response\Body;

  use Funivan\CabbageFramework\DataStructures\Stack\StringStackInterface;

  /**
   * Warning! This could attempt to load a large amount of data into memory.
   *
   * Does not send content to the output instead add it to the stack
   */
  class BufferedBody implements BodyInterface {

    /**
     * @var BodyInterface
     */
    private $original;

    /**
     * @var StringStackInterface
     */
    private $stack;


    /**
     * @param BodyInterface $original
     * @param StringStackInterface $stack
     */
    public function __construct(BodyInterface $original, StringStackInterface $stack) {
      $this->original = $original;
      $this->stack = $stack;
    }


    /**
     * Catch content and add it to the stack
     *
     * @return void
     */
    final public function send(): void {
      ob_start();
      $this->original->send();
      $data = (string) ob_get_clean();
      $this->stack->push($data);
    }


  }