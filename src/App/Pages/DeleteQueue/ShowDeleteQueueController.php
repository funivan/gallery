<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Pages\DeleteQueue;

  use Funivan\CabbageFramework\Auth\AuthComponentInterface;
  use Funivan\Gallery\App\Users\User;
  use Funivan\CabbageFs\File\File;
  use Funivan\CabbageFs\FileStorageInterface;
  use Funivan\CabbageFs\Finder\FilteredByTypeFilesList;
  use Funivan\CabbageFs\Fs\Local\LocalPath;
  use Funivan\CabbageFramework\Dispatcher\DispatcherInterface;
  use Funivan\CabbageFramework\Http\Request\RequestInterface;
  use Funivan\CabbageFramework\Http\Response\ResponseInterface;
  use Funivan\CabbageFramework\Http\Response\ViewResponse\ViewResponse;
  use Funivan\CabbageFramework\Templating\View;
  use Funivan\CabbageFramework\Templating\ViewInterface;

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