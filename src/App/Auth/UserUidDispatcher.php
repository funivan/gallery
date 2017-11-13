<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Auth;

  use Funivan\Gallery\Framework\Dispatcher\DispatcherInterface;
  use Funivan\Gallery\Framework\Http\Request\RequestInterface;
  use Funivan\Gallery\Framework\Http\Response\Cookie\ResponseCookie;
  use Funivan\Gallery\Framework\Http\Response\Cookie\ResponseWithCookie;
  use Funivan\Gallery\Framework\Http\Response\ResponseInterface;

  /**
   * Generate custom UID for the client.
   */
  class UserUidDispatcher implements DispatcherInterface {

    public const COOKIE_UID_NAME = 'user_uid';

    /**
     * @var DispatcherInterface
     */
    private $original;


    /**
     * @param DispatcherInterface $original
     */
    public function __construct(DispatcherInterface $original) {
      $this->original = $original;
    }


    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    final public function handle(RequestInterface $request): ResponseInterface {
      $response = $this->original->handle($request);
      if (!$request->cookies()->has(self::COOKIE_UID_NAME)) {
        $uid = md5(password_hash(sha1(random_int(0, 1000) . '' . time() . '678dsKK00afj%^@)@$$^'), PASSWORD_BCRYPT));
        $response = new ResponseWithCookie(
          ResponseCookie::createWithParts(self::COOKIE_UID_NAME, $uid, [ResponseCookie::HTTP_ONLY]),
          $response
        );
      }
      return $response;
    }

  }