<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Pages\ThumbPage;

  use Funivan\Gallery\App\Image\Image;
  use Funivan\Gallery\App\Image\ImageResponse;
  use Funivan\Gallery\App\Image\ThumbUid;
  use Funivan\Gallery\App\Pages\NotFound\ErrorResponse;
  use Funivan\Gallery\FileStorage\FileStorageInterface;
  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;
  use Funivan\Gallery\Framework\Dispatcher\DispatcherInterface;
  use Funivan\Gallery\Framework\Http\Request\RequestInterface;
  use Funivan\Gallery\Framework\Http\Response\ResponseInterface;

  /**
   *
   */
  class ThumbController implements DispatcherInterface {

    /**
     * @var FileStorageInterface
     */
    private $imageFs;

    /**
     * @var FileStorageInterface
     */
    private $cacheFs;


    /**
     * @param FileStorageInterface $imagesFs
     * @param FileStorageInterface $cacheFs
     */
    public function __construct(FileStorageInterface $imagesFs, FileStorageInterface $cacheFs) {
      $this->imageFs = $imagesFs;
      $this->cacheFs = $cacheFs;
    }


    /**
     * @todo take a look: Complicated code
     *
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public final function handle(RequestInterface $request): ResponseInterface {
      $path = new LocalPath(urldecode($request->get()->value('path')));
      $original = new Image($path, $this->imageFs);
      if (!$original->stored()) {
        $response = ErrorResponse::create('The image was not found.', 404);
      } else {
        $thumbUid = new ThumbUid($original);
        $thumb = new Image($thumbUid->path(), $this->cacheFs);
        $extension = $thumb->extension();
        if (!$thumb->stored()) {
          $manager = new \Intervention\Image\ImageManager(['driver' => 'imagick']);
          $img = $manager->make($original->read());
          $thumb->write(
            (string) $img->fit(300, 300)->encode($extension)
          );
        }
        $response = ImageResponse::createViewable($thumb);
      }
      return $response;
    }
  }