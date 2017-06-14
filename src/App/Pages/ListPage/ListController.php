<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Pages\ListPage;

  use Funivan\Gallery\FileStorage\File\File;
  use Funivan\Gallery\FileStorage\FileStorageInterface;
  use Funivan\Gallery\FileStorage\Finder\NameFilter;
  use Funivan\Gallery\FileStorage\Finder\TypeFilter;
  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;
  use Funivan\Gallery\Framework\Dispatcher\DispatcherInterface;
  use Funivan\Gallery\Framework\Http\Request\RequestInterface;
  use Funivan\Gallery\Framework\Http\Response\ResponseInterface;
  use Funivan\Gallery\Framework\Http\Response\ViewResponse\ViewResponse;
  use Funivan\Gallery\Framework\Templating\View;

  /**
   *
   */
  class ListController implements DispatcherInterface {

    /**
     * @var FileStorageInterface
     */
    private $imageFs;


    /**
     * @param FileStorageInterface $imagesFs
     */
    public function __construct(FileStorageInterface $imagesFs) {
      $this->imageFs = $imagesFs;
    }


    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public final function handle(RequestInterface $request): ResponseInterface {
      $currentPath = new LocalPath($request->parameters()->value('dir'));
      $baseFinder = $this->imageFs->finder($currentPath);
      $files = new TypeFilter(
        FileStorageInterface::TYPE_FILE,
        $this->imageFs,
        new NameFilter('!\.(jpg|jpeg|png)$!i', $baseFinder)
      );
      $directories = new TypeFilter(
        FileStorageInterface::TYPE_DIRECTORY,
        $this->imageFs,
        $baseFinder
      );
      $photos = [];
      foreach ($files->items() as $filePath) {
        $photos[] = File::create($filePath, $this->imageFs);
      }
      return new ViewResponse(
        View::create(__DIR__ . '/../../Layout/viewLayout.php', ['title' => 'List : ' . $currentPath->assemble()])
          ->withSubView(
            View::create(__DIR__ . '/viewList.php', [
              'photos' => $photos,
              'currentPath' => $currentPath,
              'directories' => $directories->items(),
            ])
          )
      );
    }
  }