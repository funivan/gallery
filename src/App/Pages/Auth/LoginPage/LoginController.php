<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Pages\Auth\LoginPage;

  use Funivan\Gallery\App\Users\Users;
  use Funivan\Gallery\App\Users\UsersInterface;
  use Funivan\Gallery\Framework\Auth\AuthComponentInterface;
  use Funivan\Gallery\Framework\Dispatcher\DispatcherInterface;
  use Funivan\Gallery\Framework\Http\Request\RequestInterface;
  use Funivan\Gallery\Framework\Http\Response\Redirect\RedirectResponse;
  use Funivan\Gallery\Framework\Http\Response\ResponseInterface;
  use Funivan\Gallery\Framework\Http\Response\ViewResponse\ViewResponse;
  use Funivan\Gallery\Framework\Templating\CompositeView;
  use Funivan\Gallery\Framework\Templating\View;

  /**
   *
   */
  class LoginController implements DispatcherInterface {

    /**
     * @var AuthComponentInterface
     */
    private $authComponent;


    /**
     * @var Users
     */
    private $users;


    /**
     * @param AuthComponentInterface $authComponent
     * @param UsersInterface $users
     */
    public function __construct(AuthComponentInterface $authComponent, UsersInterface $users) {
      $this->authComponent = $authComponent;
      $this->users = $users;
    }


    /**
     * @todo take a look: Multiple return statements
     *
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public final function handle(RequestInterface $request): ResponseInterface {
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
        new CompositeView(__DIR__ . '/../../../Layout/viewLayout.php', ['title' => 'Login Page'],
          new View(__DIR__ . '/viewAuthPage.php', [
            'auth' => $this->authComponent,
            'errors' => $errors,
          ])
        )
      );
      return $response;
    }

  }