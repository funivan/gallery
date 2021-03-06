<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Pages\Download;

  use Funivan\Gallery\App\Pages\NotFound\ErrorResponse;
  use Funivan\CabbageFs\File\File;
  use Funivan\CabbageFs\FileStorageInterface;
  use Funivan\CabbageFs\Fs\Local\LocalPath;
  use Funivan\CabbageFramework\Dispatcher\DispatcherInterface;
  use Funivan\CabbageFramework\Http\Request\RequestInterface;
  use Funivan\CabbageFramework\Http\Response\FileResponse\FileResponse;
  use Funivan\CabbageFramework\Http\Response\ResponseInterface;

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
    final public function handle(RequestInterface $request): ResponseInterface {
      $path = new LocalPath(urldecode($request->get()->value('path')));
      $original = File::create($path, $this->storage);
      if (!$original->exists()) {
        $response = ErrorResponse::create('Invalid image path', 404);
      } else {
        $response = FileResponse::createDownloadable($original);
      }
      return $response;
    }

  }