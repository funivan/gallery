<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Templating\Tests;

  use Funivan\Gallery\Framework\Templating\CompositeView;
  use Funivan\Gallery\Framework\Templating\View;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  final class CompositeViewTest extends TestCase {


    public function testWithSimpleSubView(): void {
      $view = new CompositeView(__DIR__ . '/fixtures/viewWrapper.php', [],
        new View(__DIR__ . '/fixtures/viewTitle.php', ['title' => 'Test title'])
      );
      self::assertSame('<div class="wrapper"><h1>Test title</h1></div>', $view->render());
    }


    public function testWithMultipleNestedViews(): void {
      $view =
        new CompositeView(__DIR__ . '/fixtures/viewWrapper.php', [],
          new CompositeView(__DIR__ . '/fixtures/viewWrapper.php', [],
            new View(__DIR__ . '/fixtures/viewTitle.php', ['title' => 'Test title'])
          )
        );
      self::assertSame('<div class="wrapper"><div class="wrapper"><h1>Test title</h1></div></div>', $view->render());
    }


    /**
     * @expectedException \Funivan\Gallery\Framework\Templating\Exception\OverwriteViewVariableException
     */
    public function testWithOverwriteData(): void {
      $view =
        new CompositeView(__DIR__ . '/fixtures/viewWrapper.php', ['content' => 'test mainViewContent'],
          new View(__DIR__ . '/fixtures/viewTitle.php', ['title' => 'title'])
        );
      $view->render();
    }


  }