<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Pages\Download;

  use Funivan\Gallery\App\Image\Image;
  use Funivan\Gallery\App\Image\ImageResponse;
  use Funivan\Gallery\App\Pages\NotFound\ErrorResponse;
  use Funivan\Gallery\FileStorage\FileStorageInterface;
  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;
  use Funivan\Gallery\Framework\Dispatcher\DispatcherInterface;
  use Funivan\Gallery\Framework\Http\Request\RequestInterface;
  use Funivan\Gallery\Framework\Http\Response\ResponseInterface;

  /**
   *
   */
  class DownloadController implements DispatcherInterface {

    /**
     * @var FileStorageInterface
     */
    private $storage;


    /**
     * @param FileStorageInterface $imagesFs
     */
    public function __construct(FileStorageInterface $imagesFs) {
      $this->storage = $imagesFs;
    }


    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public final function handle(RequestInterface $request): ResponseInterface {
      $path = new LocalPath(urldecode($request->get()->value('path')));
      $original = new Image($path, $this->storage);
      if (!$original->stored()) {
        $response = ErrorResponse::create('Invalid image path', 404);
      } else {
        $response = ImageResponse::createDownloadable($original);
      }
      return $response;
    }

  }