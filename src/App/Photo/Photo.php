<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Photo;

  use Funivan\Gallery\App\Canvas\CanvasInterface;
  use Funivan\Gallery\App\Photo\Meta\MetaFlag;
  use Funivan\Gallery\App\Photo\Meta\MetaFlagInterface;
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
     * @return MetaFlagInterface
     */
    public function favourite(): MetaFlagInterface {
      preg_match('!.*----(?<modifier>[fpd])(\.[a-z]{3,4})$!', $this->image->file()->path()->assemble(), $data);
      $result = false;
      if (array_key_exists('modifier', $data)) {
        $result = (strpos($data['modifier'], 'f') !== false);
      }
      return new MetaFlag($result);
    }


    /**
     * @return FileInterface
     */
    public function file(): FileInterface {
      return $this->image->file();
    }


    public function meta(): MetaInformation {
      return new MetaInformation($this->image->file());
    }


  }