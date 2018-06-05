<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Pages\DeleteQueue;

  use Funivan\Gallery\App\Users\User;
  use Funivan\Gallery\FileStorage\File\File;
  use Funivan\Gallery\FileStorage\FileStorageInterface;
  use Funivan\Gallery\FileStorage\Finder\FilteredByTypeFilesList;
  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;
  use Funivan\Gallery\Framework\Auth\AuthComponentInterface;
  use Funivan\Gallery\Framework\Dispatcher\DispatcherInterface;
  use Funivan\Gallery\Framework\Http\Request\RequestInterface;
  use Funivan\Gallery\Framework\Http\Response\ResponseInterface;
  use Funivan\Gallery\Framework\Http\Response\ViewResponse\ViewResponse;
  use Funivan\Gallery\Framework\Templating\View;
  use Funivan\Gallery\Framework\Templating\ViewInterface;

  class ShowDeleteQueueController implements DispatcherInterface {

    /**
     * @var FileStorageInterface
     */
    private $imagesFs;

    /**
     * @var AuthComponentInterface
     */
    private $auth;

    /**
     * @var ViewInterface
     */
    private $view;


    public function __construct(ViewInterface $view, FileStorageInterface $imagesFs, AuthComponentInterface $auth) {
      $this->imagesFs = $imagesFs;
      $this->auth = $auth;
      $this->view = $view;
    }


    final public function handle(RequestInterface $request): ResponseInterface {
      $user = new User('', '', []);
      if ($this->auth->authenticated()) {
        $user = $this->auth->user();
      }
      $files = new FilteredByTypeFilesList(
        FileStorageInterface::TYPE_FILE,
        $this->imagesFs,
        $this->imagesFs->finder(new LocalPath('/'))
      );
      $photos = [];
      foreach ($files->items() as $filePath) {
        $photos[] = File::create($filePath, $this->imagesFs);
      }
      return new ViewResponse(
        $this->view->withData(['title' => 'Delete images queue'])
          ->withSubView(
            View::create(__DIR__ . '/deleteQueueList.php', [
              'user' => $user,
              'photos' => $photos,
            ])
          )
      );
    }

  } 