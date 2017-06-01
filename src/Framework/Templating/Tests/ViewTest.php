<?php

  namespace Funivan\Gallery\Framework\Templating\Tests;

  use Funivan\Gallery\Framework\Templating\View;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  final class ViewTest extends TestCase {

    public function testSimpleRender(): void {
      $view = new View(__DIR__ . '/fixtures/viewTitle.php', ['title' => 'users']);
      self::assertSame('<h1>users</h1>', trim($view->render()));
    }


  }
