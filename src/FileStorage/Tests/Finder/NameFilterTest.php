<?php

  namespace Funivan\Gallery\FileStorage\Tests\Finder;

  use Funivan\Gallery\FileStorage\Finder\InMemoryPathFinder;
  use Funivan\Gallery\FileStorage\Finder\NameFilter;
  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;
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
