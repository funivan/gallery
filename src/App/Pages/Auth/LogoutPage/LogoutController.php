<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Pages\Auth\LogoutPage;

  use Funivan\CabbageFramework\Auth\AuthComponentInterface;
  use Funivan\Gallery\App\Pages\IndexPage\IndexUrl;
  use Funivan\CabbageFramework\Dispatcher\DispatcherInterface;
  use Funivan\CabbageFramework\Http\Request\RequestInterface;
  use Funivan\CabbageFramework\Http\Response\Redirect\RedirectResponse;
  use Funivan\CabbageFramework\Http\Response\ResponseInterface;

  /**
   *
   */
  class LogoutController implements DispatcherInterface {

    /**
     * @var \Funivan\CabbageFramework\Auth\AuthComponentInterface
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
    final public function handle(RequestInterface $request): ResponseInterface {
      $this->authComponent->logOut();
      return new RedirectResponse(new IndexUrl(), 302);
    }

  }