<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Image;

  use Funivan\CabbageFs\File\FileInterface;
  use Funivan\CabbageFs\Fs\Local\LocalPath;
  use Funivan\CabbageFs\PathInterface;

  /**
   *
   */
  class PreviewLocation implements LocationInterface {

    /**
     * @var FileInterface
     */
    private $image;


    /**
     * @param FileInterface $image
     */
    public function __construct(FileInterface $image) {
      $this->image = $image;
    }


    /**
     * @return PathInterface
     */
    final public function path(): PathInterface {
      $hash = md5($this->image->path()->assemble());
      $path = (new LocalPath(substr($hash, 0, 2)))
        ->next(
          (new LocalPath(substr($hash, 2, 2)))
            ->next(
              new LocalPath($hash . '.' . $this->image->meta('extension'))
            )
        );
      return $path;
    }

  }