<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Pages\Auth\LoginPage\Form;

  use Funivan\Gallery\App\Users\Users;
  use Funivan\Gallery\Framework\Http\Request\RequestInterface;

  /**
   *
   */
  class LoginForm {

    /**
     * @var Users
     */
    private $users;


    /**
     * @param Users $users
     */
    public function __construct(Users $users) {
      $this->users = $users;
    }


    /**
     * @param RequestInterface $request
     * @return ValidationResult
     */
    public final function validate(RequestInterface $request): ValidationResult {
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
    public final function submitted(RequestInterface $request): bool {
      $post = $request->post();
      return ($post->has('login') and $post->has('pass'));
    }


  }