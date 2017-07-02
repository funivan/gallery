<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Pages\Actions\ToggleFlag;

  use Funivan\Gallery\Framework\Http\Request\Parameters;
  use Funivan\Gallery\Framework\Router\PathRoute\PathUrl;
  use Funivan\Gallery\Framework\Router\UrlInterface;

  /**
   *
   */
  class ChangeFlagUrl implements UrlInterface {

    const SET_PATH = '/action/set-flag';

    const REMOVE_PATH = '/action/remove-flag';

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $flag;


    /**
     * @param string $url
     * @param string $flag
     */
    private function __construct(string $url, string $flag) {
      $this->flag = $flag;
      $this->url = $url;
    }


    /**
     * @param string $flag
     * @return UrlInterface
     */
    public static function createSet(string $flag): UrlInterface {
      return new self(self::SET_PATH, $flag);
    }


    /**
     * @param string $flag
     * @return UrlInterface
     */
    public static function createRemove(string $flag): UrlInterface {
      return new self(self::REMOVE_PATH, $flag);
    }


    /**
     * @return string
     */
    public function build(): string {
      return (new PathUrl(
        $this->url,
        new Parameters([
          'flag' => $this->flag,
        ]))
      )->build();
    }

  }