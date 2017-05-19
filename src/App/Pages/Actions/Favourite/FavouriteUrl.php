<?php

  namespace Funivan\Gallery\App\Pages\Actions\Favourite;

  use Funivan\Gallery\FileStorage\PathInterface;
  use Funivan\Gallery\Framework\Http\Request\Parameters;
  use Funivan\Gallery\Framework\Router\PathRoute\PathRouteBuild;
  use Funivan\Gallery\Framework\Router\RouteBuildInterface;

  /**
   *
   */
  class FavouriteUrl implements RouteBuildInterface {

    const PREFIX = '/action/change/favourite';

    /**
     * @var string
     */
    private $type;

    /**
     * @var PathInterface
     */
    private $path;


    /**
     * @param string $type
     * @param PathInterface $path
     */
    public function __construct(string $type, PathInterface $path) {
      $this->type = $type;
      $this->path = $path;
    }


    /**
     * Create url from the parameters
     *
     * @return string
     */
    public final function build(): string {
      $parameters = new Parameters(['path' => $this->path->assemble()]);
      return (new PathRouteBuild(self::PREFIX . '/' . $this->type . '/', $parameters))->build();
    }

  }
