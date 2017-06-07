<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Pages\ThumbPage;

  use Funivan\Gallery\App\Image\Painter\Painter;
  use Funivan\Gallery\App\Image\Painter\Tool\PreviewTool;
  use Funivan\Gallery\App\Image\PreviewLocation;
  use Funivan\Gallery\App\Pages\NotFound\ErrorResponse;
  use Funivan\Gallery\FileStorage\File\File;
  use Funivan\Gallery\FileStorage\FileStorageInterface;
  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;
  use Funivan\Gallery\Framework\Dispatcher\DispatcherInterface;
  use Funivan\Gallery\Framework\Http\Request\RequestInterface;
  use Funivan\Gallery\Framework\Http\Response\FileResponse\FileResponse;
  use Funivan\Gallery\Framework\Http\Response\ResponseInterface;
  use Intervention\Image\ImageManager;

  /**
   *
   */
  class PreviewController implements DispatcherInterface {

    /**
     * @var FileStorageInterface
     */
    private $imageFs;

    /**
     * @var FileStorageInterface
     */
    private $cacheFs;

    /**
     * @var ImageManager
     */
    private $imageManager;


    /**
     * @param ImageManager $imageManager
     * @param FileStorageInterface $imagesFs
     * @param FileStorageInterface $cacheFs
     */
    public function __construct(ImageManager $imageManager, FileStorageInterface $imagesFs, FileStorageInterface $cacheFs) {
      $this->imageFs = $imagesFs;
      $this->cacheFs = $cacheFs;
      $this->imageManager = $imageManager;
    }


    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public final function handle(RequestInterface $request): ResponseInterface {
      $original = File::create(
        new LocalPath(urldecode($request->get()->value('path'))),
        $this->imageFs
      );
      if (!$original->exists()) {
        $response = ErrorResponse::create('The image was not found.', 404);
      } else {
        $preview = File::create((new PreviewLocation($original))->path(), $this->cacheFs);
        if (!$preview->exists()) {
          (new Painter($this->imageManager, $preview))->paint(new PreviewTool($original));
        }
        $response = FileResponse::createViewable($preview);
      }
      return $response;
    }
  }