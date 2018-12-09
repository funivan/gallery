<?php
  declare(strict_types = 1);

  namespace Funivan\CabbageFs\Tests\Finder;

  use Funivan\CabbageFs\Finder\InMemoryPathFinder;
  use Funivan\CabbageFs\Fs\Local\LocalPath;
  use PHPUnit\Framework\TestCase;

  class InMemoryPathFinderTest extends TestCase {


    public function testMatch() {
      $finder = new InMemoryPathFinder(
        [
          '/a/user.txt',
          '/a/data.txt',
        ],
        new LocalPath('/')
      );
      self::assertSame(1, iterator_count($finder->items()));
    }
  }
