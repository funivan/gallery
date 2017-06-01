<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Pages\ListPage;

  use Funivan\Gallery\FileStorage\File\File;
  use Funivan\Gallery\FileStorage\FileStorageInterface;
  use Funivan\Gallery\FileStorage\FinderFilter;
  use Funivan\Gallery\FileStorage\FinderFilterInterface;
  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;
  use Funivan\Gallery\Framework\Dispatcher\DispatcherInterface;
  use Funivan\Gallery\Framework\Http\Request\RequestInterface;
  use Funivan\Gallery\Framework\Http\Response\ResponseInterface;
  use Funivan\Gallery\Framework\Http\Response\ViewResponse\ViewResponse;
  use Funivan\Gallery\Framework\Templating\CompositeView;
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
      $files = $this->imageFs->find(
        new FinderFilter($currentPath, FinderFilterInterface::TYPE_FILE, ['jpg', 'jpeg', 'png'])
      );
      $directories = $this->imageFs->find(
        new FinderFilter($currentPath, FinderFilterInterface::TYPE_DIR)
      );
      $photos = [];
      foreach ($files as $file) {
        $photos[] = File::create($file, $this->imageFs);
      }
      return new ViewResponse(
        new CompositeView(__DIR__ . '/../../Layout/viewLayout.php', ['title' => 'List : ' . $currentPath->assemble()],
          new View(__DIR__ . '/viewList.php', [
            'photos' => $photos,
            'currentPath' => $currentPath,
            'directories' => $directories,
          ])
        )
      );
    }
  }