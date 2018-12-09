<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Layout;

  use Funivan\CabbageFramework\Auth\AuthComponentInterface;
  use Funivan\CabbageFramework\Templating\View;
  use Funivan\CabbageFramework\Templating\ViewInterface;

  /**
   *
   */
  class Layout extends View {

    /**
     * @param \Funivan\CabbageFramework\Auth\AuthComponentInterface $auth
     * @return ViewInterface
     */
    final public static function createDefault(AuthComponentInterface $auth): ViewInterface {
      return self::create(__DIR__ . '/viewLayout.php', [
        'auth' => $auth,
      ]);
    }
  }