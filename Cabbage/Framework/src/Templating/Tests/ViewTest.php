<?php
  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Templating\Tests;

  use Funivan\CabbageFramework\Templating\View;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  final class ViewTest extends TestCase {

    public function testSimpleRender(): void {
      $view = View::create(__DIR__ . '/fixtures/viewTitle.php', ['title' => 'users']);
      self::assertSame('<h1>users</h1>', trim($view->render()));
    }


    public function testWithSimpleSubView(): void {
      $view = View::createWithView(
        __DIR__ . '/fixtures/viewWrapper.php',
        [],
        View::create(__DIR__ . '/fixtures/viewTitle.php', ['title' => 'Test title'])
      );
      self::assertSame('<div class="wrapper"><h1>Test title</h1></div>', trim($view->render()));
    }


    public function testWithMultipleNestedViews(): void {
      $view =
        View::create(__DIR__ . '/fixtures/viewWrapper.php', [])
          ->withSubView(
            View::createWithView(
              __DIR__ . '/fixtures/viewWrapper.php',
              [],
              View::create(__DIR__ . '/fixtures/viewTitle.php', ['title' => 'Test title'])
            )
          );
      self::assertSame('<div class="wrapper"><div class="wrapper"><h1>Test title</h1></div></div>', str_replace("\n", '', $view->render()));
    }


    /**
     * @expectedException \Funivan\CabbageFramework\Templating\Exception\OverwriteViewVariableException
     */
    public function testWithOverwriteData(): void {
      $view = View::create(__DIR__ . '/fixtures/viewWrapper.php', ['content' => 'test mainViewContent'])
        ->withSubView(
          View::create(__DIR__ . '/fixtures/viewTitle.php', ['title' => 'title'])
        );
      $view->render();
    }


  }
