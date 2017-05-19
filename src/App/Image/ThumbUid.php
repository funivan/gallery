<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Image;

  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;
  use Funivan\Gallery\FileStorage\PathInterface;

  /**
   *
   */
  class ThumbUid {

    /**
     * @var Image
     */
    private $image;


    /**
     * @param Image $image
     */
    public function __construct(Image $image) {
      $this->image = $image;
    }


    /**
     * @return PathInterface
     */
    public final function path(): PathInterface {
      $hash = md5($this->image->path()->assemble());
      $path = (new LocalPath(substr($hash, 0, 2)))
        ->next(
          (new LocalPath(substr($hash, 2, 2)))
            ->next(
              new LocalPath($hash . '.' . $this->image->extension())
            )
        );
      return $path;
    }

  }