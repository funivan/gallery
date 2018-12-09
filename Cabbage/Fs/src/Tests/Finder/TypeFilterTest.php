<?php
  declare(strict_types = 1);

  namespace Funivan\CabbageFs\Tests\Finder;

  use Funivan\CabbageFs\FileStorageInterface;
  use Funivan\CabbageFs\Finder\FilteredByTypeFilesList;
  use Funivan\CabbageFs\Fs\Local\LocalPath;
  use Funivan\CabbageFs\Fs\Memory\MemoryStorage;
  use PHPUnit\Framework\TestCase;

  class TypeFilterTest extends TestCase {


    public function testDirectory() {
      $fs = new MemoryStorage();
      $fs->write(new LocalPath('/test.php'), 'test');
      $fs->write(new LocalPath('/test/a.php'), 'a');
      $fs->write(new LocalPath('/data/b.php'), 'b');
      $fs->write(new LocalPath('/user/c.php'), 'c');
      $items = iterator_to_array(
        (new FilteredByTypeFilesList(
          FileStorageInterface::TYPE_DIRECTORY,
          $fs,
          $fs->finder(new LocalPath('/'))
        ))
          ->items()
      );
      self::assertCount(3, $items);
    }

  }
