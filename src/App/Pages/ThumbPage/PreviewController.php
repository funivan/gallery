<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Pages\ThumbPage;

  use Funivan\Gallery\App\Canvas\Canvas;
  use Funivan\Gallery\App\Canvas\Painter\PainterMaster;
  use Funivan\Gallery\App\Canvas\Painter\PreviewTool;
  use Funivan\Gallery\App\Canvas\PreviewLocation;
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
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public final function handle(RequestInterface $request): ResponseInterface {
      $image = Canvas::createFromRawPath(
        new LocalPath(urldecode($request->get()->value('path'))),
        $this->imageFs
      );
      $original = $image->file();
      if (!$original->exists()) {
        $response = ErrorResponse::create('The image was not found.', 404);
      } else {
        $preview = File::create((new PreviewLocation($original))->path(), $this->cacheFs);
        if (!$preview->exists()) {
          (new PainterMaster($preview))->paint(new PreviewTool($image));
        }
        $response = FileResponse::createViewable($preview);
      }
      return $response;
    }
  }