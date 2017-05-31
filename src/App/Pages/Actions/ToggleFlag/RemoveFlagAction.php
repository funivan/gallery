<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Pages\Actions\ToggleFlag;

  use Funivan\Gallery\App\Canvas\CanvasInterface;
  use Funivan\Gallery\App\Pages\Actions\ImageActionInterface;
  use Funivan\Gallery\App\Photo\Flag\Flags;

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
     * @param CanvasInterface $photo
     * @return void
     */
    public function execute(CanvasInterface $photo): void {
      (new Flags($photo->file()))->remove($this->flag);
    }

  }