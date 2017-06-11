<?php

  namespace Funivan\Gallery\FileStorage\Tests\Finder;

  use Funivan\Gallery\FileStorage\Finder\InMemoryPathFinder;
  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;
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
