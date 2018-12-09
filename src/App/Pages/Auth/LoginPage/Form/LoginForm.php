<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Pages\Auth\LoginPage\Form;

  use Funivan\Gallery\App\Users\UsersInterface;
  use Funivan\CabbageFramework\Http\Request\RequestInterface;

  /**
   *
   */
  class LoginForm implements FormInterface {

    /**
     * @var UsersInterface
     */
    private $users;


    /**
     * @param UsersInterface $users
     */
    public function __construct(UsersInterface $users) {
      $this->users = $users;
    }


    /**
     * @param RequestInterface $request
     * @return ValidationResult
     */
    final public function validate(RequestInterface $request): ValidationResult {
      $errors = [];
      $post = $request->post();
      $userUid = $post->value('login');
      if (!$this->users->has($userUid)) {
        $errors[] = 'Invalid user login';
      } else {
        $password = $post->value('pass');
        $user = $this->users->get($userUid);
        if (!$user->validatePassword($password)) {
          $errors[] = 'Invalid user password';
        }
      }
      return new ValidationResult($errors);
    }


    /**
     * @param RequestInterface $request
     * @return bool
     */
    final public function submitted(RequestInterface $request): bool {
      $post = $request->post();
      return ($post->has('login') and $post->has('pass'));
    }


  }