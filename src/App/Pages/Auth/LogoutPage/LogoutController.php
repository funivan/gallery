<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\App\Pages\Auth\LogoutPage;

  use Funivan\Gallery\Framework\Auth\AuthComponentInterface;
  use Funivan\Gallery\Framework\Dispatcher\DispatcherInterface;
  use Funivan\Gallery\Framework\Http\Request\RequestInterface;
  use Funivan\Gallery\Framework\Http\Response\Plain\PlainResponse;
  use Funivan\Gallery\Framework\Http\Response\ResponseInterface;

  /**
   *
   */
  class LogoutController implements DispatcherInterface {

    /**
     * @var AuthComponentInterface
     */
    private $authComponent;


    /**
     * @param AuthComponentInterface $authComponent
     */
    public function __construct(AuthComponentInterface $authComponent) {
      $this->authComponent = $authComponent;
    }


    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public final function handle(RequestInterface $request): ResponseInterface {
      $this->authComponent->logOut();
      return PlainResponse::create('Logged out');
    }

  }