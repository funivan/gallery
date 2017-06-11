<?php

  namespace Funivan\Gallery\FileStorage\Tests\Finder;

  use Funivan\Gallery\FileStorage\FileStorageInterface;
  use Funivan\Gallery\FileStorage\Finder\TypeFilter;
  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;
  use Funivan\Gallery\FileStorage\Fs\Memory\MemoryStorage;
  use PHPUnit\Framework\TestCase;

  class TypeFilterTest extends TestCase {


    public function testDirectory() {
      $fs = new MemoryStorage();
      $fs->write(new LocalPath('/test.php'), 'test');
      $fs->write(new LocalPath('/test/a.php'), 'a');
      $fs->write(new LocalPath('/data/b.php'), 'b');
      $fs->write(new LocalPath('/user/c.php'), 'c');
      $items = iterator_to_array(
        (new TypeFilter(
          FileStorageInterface::TYPE_DIRECTORY,
          $fs,
          $fs->finder(new LocalPath('/'))
        ))
          ->items()
      );
      self::assertCount(3, $items);
    }

  }
