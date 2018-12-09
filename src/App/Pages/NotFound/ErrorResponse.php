<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Pages\NotFound;

  use Funivan\CabbageFramework\Http\Response\Body\BodyInterface;
  use Funivan\CabbageFramework\Http\Response\Headers\Headers;
  use Funivan\CabbageFramework\Http\Response\HeadersInterface;
  use Funivan\CabbageFramework\Http\Response\ResponseInterface;
  use Funivan\CabbageFramework\Http\Response\Status\ResponseStatus;
  use Funivan\CabbageFramework\Http\Response\StatusInterface;
  use Funivan\CabbageFramework\Http\Response\ViewResponse\ViewBody;
  use Funivan\CabbageFramework\Templating\View;

  /**
   *
   */
  class ErrorResponse implements ResponseInterface {

    /**
     * @var string
     */
    private $message;


    /**
     * @var int
     */
    private $code;

    /**
     * @var string
     */
    private $description;


    /**
     * @param string $message
     * @param int $code
     * @param string $description
     * @internal param HeadersInterface $headers
     */
    private function __construct(string $message, int $code, string $description) {
      $this->message = $message;
      $this->code = $code;
      $this->description = $description;
    }


    /**
     * @param string $message
     * @param int $code
     * @param string $description
     * @return ErrorResponse
     */
    public static function createWithDescription(string $message, int $code, string $description): ErrorResponse {
      return new self($message, $code, $description);
    }


    /**
     * @param string $message
     * @param int $code
     * @return ErrorResponse
     */
    public static function create(string $message, int $code): ErrorResponse {
      return new self($message, $code, '');
    }


    /**
     * @return \Funivan\CabbageFramework\Http\Response\StatusInterface
     */
    final public function status(): StatusInterface {
      return new ResponseStatus($this->code);
    }


    /**
     * @return HeadersInterface
     */
    final public function headers(): HeadersInterface {
      return new Headers([]);
    }


    /**
     * @return \Funivan\CabbageFramework\Http\Response\Body\BodyInterface
     */
    final public function body(): BodyInterface {
      $view = View::create(__DIR__ . '/../../Layout/viewLayout.php', ['title' => 'Error'])
        ->withSubView(
          View::create(__DIR__ . '/viewError.php', [
            'phrase' => $this->message,
            'description' => $this->description,
          ])
        );
      return new ViewBody($view);
    }

  }