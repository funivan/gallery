<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\Framework\Auth;

  use Funivan\Gallery\Framework\Auth\Exception\AccessDeniedException;
  use Funivan\Gallery\Framework\Dispatcher\DispatcherInterface;
  use Funivan\Gallery\Framework\Http\Request\RequestInterface;
  use Funivan\Gallery\Framework\Http\Response\ResponseInterface;

  /**
   * Check if client has permission to execute the dispatcher
   */
  class AuthorizationDispatcher implements DispatcherInterface {

    /**
     * @var string
     */
    private $rule;

    /**
     * @var AuthComponentInterface
     */
    private $authComponent;

    /**
     * @var DispatcherInterface
     */
    private $original;


    /**
     * @param string $rule
     * @param AuthComponentInterface $authComponent
     * @param DispatcherInterface $next
     */
    public function __construct(string $rule, AuthComponentInterface $authComponent, DispatcherInterface $next) {
      $this->rule = $rule;
      $this->authComponent = $authComponent;
      $this->original = $next;
    }


    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws AccessDeniedException
     */
    public final function handle(RequestInterface $request): ResponseInterface {
      $user = $this->authComponent->user();
      if (!$user->authorized($this->rule)) {
        throw new AccessDeniedException(
          sprintf('User %s does not have permission to execute action %s', $user->uid(), $this->rule)
        );
      }
      return $this->original->handle($request);
    }

  }