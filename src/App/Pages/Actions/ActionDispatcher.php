<?php

  namespace Funivan\Gallery\App\Pages\Actions;

  use Funivan\Gallery\App\Canvas\Canvas;
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
      $original = Canvas::createFromRawPath(
        new LocalPath(urldecode($request->get()->value('path'))),
        $this->storage
      );
      if (!$original->original()->exists()) {
        $response = PlainResponse::create('{error:"image not found"}');
      } else {
        $this->action->execute($original);
        $response = PlainResponse::create('{result:"ok"}');
      }
      return $response;
    }

  }
