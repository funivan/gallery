<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Pages\Actions\ToggleFlag;

  use Funivan\Gallery\FileStorage\PathInterface;
  use Funivan\Gallery\Framework\Http\Request\Parameters;
  use Funivan\Gallery\Framework\Router\PathRoute\PathUrl;
  use Funivan\Gallery\Framework\Router\UrlInterface;

  /**
   *
   */
  class ChangeFlagUrl implements UrlInterface {

    public const SET_PATH = '/action/set-flag';

    public const REMOVE_PATH = '/action/remove-flag';

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $flag;


    /**
     * @var PathInterface
     */
    private $path;


    /**
     * @param string $url
     * @param string $flag
     * @param PathInterface $path
     */
    private function __construct(string $url, string $flag, PathInterface $path) {
      $this->flag = $flag;
      $this->path = $path;
      $this->url = $url;
    }


    /**
     * @param string $flag
     * @param PathInterface $path
     * @return UrlInterface
     */
    public static function createSet(string $flag, PathInterface $path): UrlInterface {
      return new self(self::SET_PATH, $flag, $path);
    }


    /**
     * @param string $flag
     * @param PathInterface $path
     * @return UrlInterface
     */
    public static function createRemove(string $flag, PathInterface $path): UrlInterface {
      return new self(self::REMOVE_PATH, $flag, $path);
    }


    /**
     * @return string
     */
    public function build(): string {
      return (new PathUrl(
        $this->url,
        new Parameters([
          'path' => $this->path->assemble(),
          'flag' => $this->flag,
        ]))
      )->build();
    }

  }