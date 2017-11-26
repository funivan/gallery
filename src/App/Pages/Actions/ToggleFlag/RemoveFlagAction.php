<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Pages\Actions\ToggleFlag;

  use Funivan\Gallery\App\Pages\Actions\ImageActionInterface;
  use Funivan\Gallery\App\Photo\Flag\Flags;
  use Funivan\Gallery\FileStorage\File\FileInterface;

  /**
   *
   */
  class RemoveFlagAction implements ImageActionInterface {

    /**
     * @var string
     */
    private $flag;


    /**
     * @param string $flag
     */
    public function __construct(string $flag) {
      $this->flag = $flag;
    }


    /**
     * @param FileInterface $photo
     * @return FileInterface
     */
    final public function execute(FileInterface $photo): FileInterface {
      return (new Flags($photo))->remove($this->flag);
    }

  }