<?php

  namespace Funivan\Gallery\App\Pages\Actions;

  use Funivan\Gallery\App\Pages\NotFound\ErrorResponse;
  use Funivan\Gallery\FileStorage\File\File;
  use Funivan\Gallery\FileStorage\FileStorageInterface;
  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;
  use Funivan\Gallery\Framework\Dispatcher\DispatcherInterface;
  use Funivan\Gallery\Framework\Http\Request\RequestInterface;
  use Funivan\Gallery\Framework\Http\Response\Plain\PlainResponse;
  use Funivan\Gallery\Framework\Http\Response\ResponseInterface;

  /**
   *
   */
  class ActionDispatcher implements DispatcherInterface {

    /**
     * @var ImageActionInterface
     */
    private $action;

    /**
     * @var FileStorageInterface
     */
    private $storage;


    /**
     * @param ImageActionInterface $action
     * @param FileStorageInterface $fileStorage
     */
    public function __construct(ImageActionInterface $action, FileStorageInterface $fileStorage) {
      $this->action = $action;
      $this->storage = $fileStorage;
    }


    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public final function handle(RequestInterface $request): ResponseInterface {
      $original = File::create(
        new LocalPath(urldecode($request->get()->value('path'))),
        $this->storage
      );
      if (!$original->exists()) {
        $response = ErrorResponse::create('{error:"image not found"}', 500);
      } else {
        $file = $this->action->execute($original);
        $response = PlainResponse::create(
          json_encode([
            'result' => 'ok',
            'path' => $file->path()->assemble(),
          ])
        );
      }
      return $response;
    }

  }
