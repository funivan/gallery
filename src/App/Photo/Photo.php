<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Photo;

  use Funivan\Gallery\App\Canvas\CanvasInterface;
  use Funivan\Gallery\FileStorage\File\FileInterface;

  /**
   *
   */
  class Photo implements PhotoInterface {

    /**
     * @var CanvasInterface
     */
    private $image;


    /**
     * @param CanvasInterface $image
     */
    public function __construct(CanvasInterface $image) {
      $this->image = $image;
    }


    /**
     * @return StateInterface
     */
    public function favourite(): StateInterface {
      preg_match('!.*----(?<modifier>[fpd])(\.[a-z]{3,4})$!', $this->image->original()->path()->assemble(), $data);
      $result = false;
      if (array_key_exists('modifier', $data)) {
        $result = (strpos($data['modifier'], 'f') !== false);
      }
      return new State($result);
    }


    /**
     * @return FileInterface
     */
    public function original(): FileInterface {
      return $this->image->original();
    }


    /**
     * @return string
     */
    public function name(): string {
      return preg_replace('!.*--([fpd])(\.[a-z]{3,4})$!', '$1', $this->image->original()->path());
    }


  }