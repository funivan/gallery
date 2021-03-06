<?php

  declare(strict_types = 1);

  use Funivan\CabbageFramework\Auth\AuthenticationDispatcher;
  use Funivan\CabbageFramework\Auth\AuthorizationDispatcher;
  use Funivan\Gallery\App\Auth\FileBasedAuthComponent;
  use Funivan\Gallery\App\Auth\UserUidDispatcher;
  use Funivan\Gallery\App\Configuration;
  use Funivan\Gallery\App\Layout\Layout;
  use Funivan\Gallery\App\Pages\Actions\ActionDispatcher;
  use Funivan\Gallery\App\Pages\Actions\ActionRouteMatch;
  use Funivan\Gallery\App\Pages\Actions\Rotate\ImageRotateAction;
  use Funivan\Gallery\App\Pages\Actions\Rotate\ImageRotateUrl;
  use Funivan\Gallery\App\Pages\Actions\RuleIds;
  use Funivan\Gallery\App\Pages\Actions\ToggleFlag\ChangeFlagUrl;
  use Funivan\Gallery\App\Pages\Actions\ToggleFlag\RemoveFlagAction;
  use Funivan\Gallery\App\Pages\Actions\ToggleFlag\SetFlagAction;
  use Funivan\Gallery\App\Pages\Auth\LoginPage\LoginController;
  use Funivan\Gallery\App\Pages\Auth\LoginPage\LoginUrl;
  use Funivan\Gallery\App\Pages\Auth\LogoutPage\LogoutController;
  use Funivan\Gallery\App\Pages\Auth\LogoutPage\LogoutUrl;
  use Funivan\Gallery\App\Pages\DeleteQueue\ShowDeleteQueueController;
  use Funivan\Gallery\App\Pages\DeleteQueue\ShowDeleteQueueUrl;
  use Funivan\Gallery\App\Pages\Download\DownloadController;
  use Funivan\Gallery\App\Pages\Download\DownloadUrl;
  use Funivan\Gallery\App\Pages\IndexPage\IndexController;
  use Funivan\Gallery\App\Pages\IndexPage\IndexUrl;
  use Funivan\Gallery\App\Pages\ListPage\ListController;
  use Funivan\Gallery\App\Pages\ListPage\ListUrl;
  use Funivan\Gallery\App\Pages\ThumbPage\PreviewController;
  use Funivan\Gallery\App\Pages\ThumbPage\PreviewUrl;
  use Funivan\Gallery\App\Photo\Flag\FlagsInterface;
  use Funivan\Gallery\App\SafeDispatcher;
  use Funivan\Gallery\App\Users\Users;
  use Funivan\CabbageFs\File\File;
  use Funivan\CabbageFs\Fs\Local\LocalFsStorage;
  use Funivan\CabbageFs\Fs\Local\LocalPath;
  use Funivan\CabbageFs\Fs\Local\Operation\DirectoryAutomaticCreation;
  use Funivan\CabbageFramework\Dispatcher\App;
  use Funivan\CabbageFramework\Dispatcher\StaticDispatcher;
  use Funivan\CabbageFramework\Http\Request\Cookie\RequestCookies;
  use Funivan\CabbageFramework\Http\Request\Parameters;
  use Funivan\CabbageFramework\Http\Request\Request;
  use Funivan\CabbageFramework\Http\Response\Redirect\RedirectResponse;
  use Funivan\CabbageFramework\Router\ParameterRoute\HasParameterConstrain;
  use Funivan\CabbageFramework\Router\ParameterRoute\ParameterRoutMatch;
  use Funivan\CabbageFramework\Router\PathRoute\PathRouteMatch;
  use Funivan\CabbageFramework\Router\RegexRoute\RegexRouteMatch;
  use Funivan\CabbageFramework\Router\Route;
  use Funivan\CabbageFramework\Router\RouterDispatcher;

  require_once __DIR__ . '/../vendor/autoload.php';

  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  $serverData = $_SERVER;
  if (!array_key_exists('PATH_INFO', $serverData)) {
    $serverData['PATH_INFO'] = '/'; //PHP WAT
  }

  $request = new Request(
    new Parameters($_GET),
    new Parameters($_POST),
    new Parameters($serverData),
    new Parameters([]),
    RequestCookies::createFromRaw($_COOKIE)
  );

  $configuration = new Configuration(__DIR__ . '/../configuration.ini');
  $imagesFs = LocalFsStorage::create($configuration->baseImagePath());
  $cacheFs = LocalFsStorage::createWithDirectoryCheck(new LocalPath(__DIR__ . '/../cache'), new DirectoryAutomaticCreation());
  $authStorageFs = LocalFsStorage::create(new LocalPath(__DIR__ . '/../storage'));

  $dataStorage = LocalFsStorage::create(new LocalPath(__DIR__ . '/../data'));
  $users = new Users(File::create(new LocalPath('users.json'), $dataStorage));

  $imageManager = new \Intervention\Image\ImageManager(['driver' => 'gd']);
  $authComponent = new FileBasedAuthComponent($request->cookies(), $authStorageFs, $users);

  $view = Layout::createDefault($authComponent);
  /** @noinspection HtmlUnknownTag */
  $app = new App(
    new SafeDispatcher( # Catch all exceptions and provide nice Response
      new UserUidDispatcher( # Generate UID for the user. And store it in the session
        new RouterDispatcher([
          # Simple Route. If we match url - then execute index controller
          new Route(
            new PathRouteMatch(IndexUrl::PREFIX),
            new IndexController($view)
          ),
          # Multilevel check
          # First check parameter 'path' in GET and then check path route
          new Route(
            ParameterRoutMatch::createWithNext('GET', new HasParameterConstrain('path'),
              new PathRouteMatch(DownloadUrl::PREFIX)
            ),
            new DownloadController($imagesFs)
          ),
          new Route(
            new PathRouteMatch(PreviewUrl::PREFIX),
            new PreviewController($imageManager, $imagesFs, $cacheFs)
          ),
          # Check path by regex and then, according to the data, check what dispatcher we should call
          # This technique can be used for groups
          # Also we check authentication and authorization of the user
          new Route(
            new RegexRouteMatch('/action/.*'),
            new AuthenticationDispatcher(
              $authComponent,
              new StaticDispatcher(new RedirectResponse(new LoginUrl(), 302)),
              new RouterDispatcher([
                new Route(
                  new ActionRouteMatch(ChangeFlagUrl::SET_PATH, FlagsInterface::FAVOURITE),
                  new AuthorizationDispatcher(
                    RuleIds::FAVOURITE_SET,
                    $authComponent,
                    new ActionDispatcher(new SetFlagAction(FlagsInterface::FAVOURITE), $imagesFs)
                  )
                ),
                new Route(
                  new ActionRouteMatch(ChangeFlagUrl::REMOVE_PATH, FlagsInterface::FAVOURITE),
                  new AuthorizationDispatcher(
                    RuleIds::FAVOURITE_REMOVE,
                    $authComponent,
                    new ActionDispatcher(new RemoveFlagAction(FlagsInterface::FAVOURITE), $imagesFs)
                  )
                ),
                new Route(
                  new ActionRouteMatch(ChangeFlagUrl::SET_PATH, FlagsInterface::PRIVATE),
                  new AuthorizationDispatcher(
                    RuleIds::PRIVATE_SET,
                    $authComponent,
                    new ActionDispatcher(new SetFlagAction(FlagsInterface::PRIVATE), $imagesFs)
                  )
                ),
                new Route(
                  new ActionRouteMatch(ChangeFlagUrl::REMOVE_PATH, FlagsInterface::PRIVATE),
                  new AuthorizationDispatcher(
                    RuleIds::PRIVATE_REMOVE,
                    $authComponent,
                    new ActionDispatcher(new RemoveFlagAction(FlagsInterface::PRIVATE), $imagesFs)
                  )
                ),
                new Route(
                  new ActionRouteMatch(ChangeFlagUrl::SET_PATH, FlagsInterface::DELETED),
                  new AuthorizationDispatcher(
                    RuleIds::MOVE_TO_TRASH,
                    $authComponent,
                    new ActionDispatcher(new SetFlagAction(FlagsInterface::DELETED), $imagesFs)
                  )
                ),
                new Route(
                  new ActionRouteMatch(ChangeFlagUrl::REMOVE_PATH, FlagsInterface::DELETED),
                  new AuthorizationDispatcher(
                    RuleIds::RESTORE_FROM_TRASH,
                    $authComponent,
                    new ActionDispatcher(new RemoveFlagAction(FlagsInterface::DELETED), $imagesFs)
                  )
                ),
                new Route(
                  new PathRouteMatch(ImageRotateUrl::PREFIX),
                  new AuthorizationDispatcher(
                    RuleIds::ROTATE,
                    $authComponent,
                    new ActionDispatcher(new ImageRotateAction(90, $imageManager, $cacheFs), $imagesFs)
                  )
                ),
              ])
            )
          ),
          new Route(
            new RegexRouteMatch(ListUrl::REGEX),
            new ListController($view, $imagesFs, $authComponent)
          ),
          new Route(
            new RegexRouteMatch(LoginUrl::PREFIX),
            new LoginController($view, $authComponent, $users)
          ),
          new Route(
            new RegexRouteMatch(LogoutUrl::PREFIX),
            new LogoutController($authComponent)
          ),
          new Route(
            new RegexRouteMatch(ShowDeleteQueueUrl::URL),
            new AuthorizationDispatcher(
              RuleIds::LIST_TRASH,
              $authComponent,
              new ShowDeleteQueueController($view, $imagesFs, $authComponent)
            )
          ),
        ]))
    )
  );

  $app->run($request);
