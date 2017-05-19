<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Pages\ThumbPage;

  use Funivan\Gallery\App\Image\ThumbUid;
  use Funivan\Gallery\App\Pages\NotFound\ErrorResponse;
  use Funivan\Gallery\FileStorage\File\File;
  use Funivan\Gallery\FileStorage\FileStorageInterface;
  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;
  use Funivan\Gallery\Framework\Dispatcher\DispatcherInterface;
  use Funivan\Gallery\Framework\Http\Request\RequestInterface;
  use Funivan\Gallery\Framework\Http\Response\FileResponse\FileResponse;
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
      $original = File::create($path, $this->imageFs);
      if (!$original->exists()) {
        $response = ErrorResponse::create('The image was not found.', 404);
      } else {
        $thumbUid = new ThumbUid($original);
        $thumb = File::create($thumbUid->path(), $this->cacheFs);
        $extension = $thumb->meta('extension');
        if (!$thumb->exists()) {
          $manager = new \Intervention\Image\ImageManager(['driver' => 'imagick']);
          $img = $manager->make($original->read());
          $thumb->write(
            (string) $img->fit(300, 300)->encode($extension)
          );
        }
        $response = FileResponse::createViewable($thumb);
      }
      return $response;
    }
  }