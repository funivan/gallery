<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Layout;

  use Funivan\Gallery\Framework\Auth\AuthComponentInterface;
  use Funivan\Gallery\Framework\Templating\View;
  use Funivan\Gallery\Framework\Templating\ViewInterface;

  /**
   *
   */
  class Layout extends View {

    /**
     * @param AuthComponentInterface $auth
     * @return ViewInterface
     */
    final public static function createDefault(AuthComponentInterface $auth): ViewInterface {
      return self::create(__DIR__ . '/viewLayout.php', [
        'auth' => $auth,
      ]);
    }
  }