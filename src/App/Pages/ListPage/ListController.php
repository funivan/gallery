<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Pages\ListPage;

  use Funivan\Gallery\App\Users\User;
  use Funivan\Gallery\FileStorage\File\File;
  use Funivan\Gallery\FileStorage\FileStorageInterface;
  use Funivan\Gallery\FileStorage\Finder\FilteredByTypeFilesList;
  use Funivan\Gallery\FileStorage\Finder\NameFilter;
  use Funivan\Gallery\FileStorage\Finder\OrderByName;
  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;
  use Funivan\Gallery\Framework\Auth\AuthComponentInterface;
  use Funivan\Gallery\Framework\Dispatcher\DispatcherInterface;
  use Funivan\Gallery\Framework\Http\Request\RequestInterface;
  use Funivan\Gallery\Framework\Http\Response\ResponseInterface;
  use Funivan\Gallery\Framework\Http\Response\ViewResponse\ViewResponse;
  use Funivan\Gallery\Framework\Templating\View;
  use Funivan\Gallery\Framework\Templating\ViewInterface;

  /**
   *
   */
  class ListController implements DispatcherInterface {

    /**
     * @var FileStorageInterface
     */
    private $imageFs;

    /**
     * @var ViewInterface
     */
    private $view;

    /**
     * @var AuthComponentInterface
     */
    private $auth;


    /**
     * @param ViewInterface $view
     * @param FileStorageInterface $imagesFs
     * @param AuthComponentInterface $auth
     */
    public function __construct(ViewInterface $view, FileStorageInterface $imagesFs, AuthComponentInterface $auth) {
      $this->view = $view;
      $this->imageFs = $imagesFs;
      $this->auth = $auth;
    }


    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    final public function handle(RequestInterface $request): ResponseInterface {
      $currentPath = new LocalPath($request->parameters()->value('dir'));
      $baseFinder = $this->imageFs->finder($currentPath);
      $files = new OrderByName(
        new FilteredByTypeFilesList(
          FileStorageInterface::TYPE_FILE,
          $this->imageFs,
          new NameFilter(
            '!\.(jpg|jpeg|png)$!i',
            $baseFinder
          )
        )
      );
      $directories = new OrderByName(
        new FilteredByTypeFilesList(
          FileStorageInterface::TYPE_DIRECTORY,
          $this->imageFs,
          $baseFinder
        ),
        false
      );
      //@todo convert to photos list
      $photos = [];
      foreach ($files->items() as $filePath) {
        $photos[] = File::create($filePath, $this->imageFs);
      }
      $user = new User('', '', []);
      if ($this->auth->authenticated()) {
        $user = $this->auth->user();
      }
      return new ViewResponse(
        $this->view->withData(['title' => 'List : ' . $currentPath->assemble()])
          ->withSubView(
            View::create(__DIR__ . '/viewList.php', [
              'user' => $user,
              'photos' => $photos,
              'currentPath' => $currentPath,
              'directories' => $directories->items(),
            ])
          )
      );
    }
  }