<?php

  namespace Funivan\Gallery\App\Pages\Actions;

  use Funivan\Gallery\App\Image\Image;
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
      $path = new LocalPath(urldecode($request->get()->value('path')));
      $original = new Image($path, $this->storage);
      if (!$original->stored()) {
        $response = PlainResponse::create('{error:"image not found"}');
      } else {
        $this->action->execute($original);
        $response = PlainResponse::create('{result:"ok"}');
      }
      return $response;
    }

  }
