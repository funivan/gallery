<?php
  declare(strict_types = 1);

  namespace Funivan\CabbageFs\Tests\Finder;

  use Funivan\CabbageFs\Finder\InMemoryPathFinder;
  use Funivan\CabbageFs\Finder\NameFilter;
  use Funivan\CabbageFs\Fs\Local\LocalPath;
  use PHPUnit\Framework\TestCase;

  class NameFilterTest extends TestCase {

    public function testMathSuccess() {
      $filter = new NameFilter(
        '![a-z]+\.txt$!',
        new InMemoryPathFinder(
          [
            '/test/a.txt',
            '/test/c1.txt',
          ],
          new LocalPath('/test')
        )
      );
      self::assertSame(
        1,
        iterator_count($filter->items())
      );
    }
  }
