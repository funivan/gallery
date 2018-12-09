<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Pages\Auth\LoginPage;

  use Funivan\CabbageFramework\Auth\AuthComponentInterface;
  use Funivan\Gallery\App\Users\UsersInterface;
  use Funivan\CabbageFramework\Dispatcher\DispatcherInterface;
  use Funivan\CabbageFramework\Http\Request\RequestInterface;
  use Funivan\CabbageFramework\Http\Response\Redirect\RedirectResponse;
  use Funivan\CabbageFramework\Http\Response\ResponseInterface;
  use Funivan\CabbageFramework\Http\Response\ViewResponse\ViewResponse;
  use Funivan\CabbageFramework\Templating\View;
  use Funivan\CabbageFramework\Templating\ViewInterface;

  /**
   *
   */
  class LoginController implements DispatcherInterface {

    /**
     * @var \Funivan\CabbageFramework\Auth\AuthComponentInterface
     */
    private $authComponent;


    /**
     * @var UsersInterface
     */
    private $users;

    /**
     * @var ViewInterface
     */
    private $view;


    /**
     * @param ViewInterface $view
     * @param AuthComponentInterface $authComponent
     * @param UsersInterface $users
     */
    public function __construct(ViewInterface $view, AuthComponentInterface $authComponent, UsersInterface $users) {
      $this->view = $view;
      $this->authComponent = $authComponent;
      $this->users = $users;
    }


    /**
     * @todo take a look: Multiple return statements
     *
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    final public function handle(RequestInterface $request): ResponseInterface {
      $errors = [];
      $form = new Form\LoginForm($this->users);
      if ($form->submitted($request)) {
        $validation = $form->validate($request);
        if ($validation->valid()) {
          $this->authComponent->logIn($this->users->get($request->post()->value('login')));
          return new RedirectResponse(new LoginUrl(), 301);
        }
        $errors[] = $validation->errors();
      }
      $response = new ViewResponse(
        $this->view->withData(['title' => 'Login Page'])
          ->withSubView(
            View::create(__DIR__ . '/viewAuthPage.php', [
              'auth' => $this->authComponent,
              'errors' => $errors,
            ])
          )
      );
      return $response;
    }

  }