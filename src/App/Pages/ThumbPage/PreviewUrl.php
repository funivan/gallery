<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Pages\ThumbPage;

  use Funivan\CabbageFs\PathInterface;
  use Funivan\CabbageFramework\Http\Request\Parameters;
  use Funivan\CabbageFramework\Router\PathRoute\PathUrl;

  /**
   *
   */
  final class PreviewUrl extends PathUrl {

    public const PREFIX = '/preview/';


    /**
     * @todo take a look: Not code free constructor
     *
     * @param PathInterface $path
     * @param string|null $stamp
     */
    public function __construct(PathInterface $path, string $stamp = null) {
      $parameters = [
        'path' => $path->assemble(),
      ];
      if (null !== $stamp) {
        $parameters['stamp'] = $stamp;
      }
      parent::__construct(self::PREFIX, new Parameters($parameters));
    }

  }