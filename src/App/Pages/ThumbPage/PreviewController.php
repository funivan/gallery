<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Pages\ThumbPage;

  use Funivan\Gallery\App\Image\Image;
  use Funivan\Gallery\App\Image\Painter\PreviewPainter;
  use Funivan\Gallery\App\Pages\NotFound\ErrorResponse;
  use Funivan\Gallery\FileStorage\FileStorageInterface;
  use Funivan\Gallery\Framework\Dispatcher\DispatcherInterface;
  use Funivan\Gallery\Framework\Http\Request\RequestInterface;
  use Funivan\Gallery\Framework\Http\Response\FileResponse\FileResponse;
  use Funivan\Gallery\Framework\Http\Response\ResponseInterface;

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
      $path = urldecode($request->get()->value('path'));
      $image = Image::createFromRawPath($path, $this->imageFs);
      $original = $image->original();
      if (!$original->exists()) {
        $response = ErrorResponse::create('The image was not found.', 404);
      } else {
        $preview = $image->preview($this->cacheFs);
        if (!$preview->exists()) {
          (new PreviewPainter())->paint($original, $preview);
        }
        $response = FileResponse::createViewable($preview);
      }
      return $response;
    }
  }