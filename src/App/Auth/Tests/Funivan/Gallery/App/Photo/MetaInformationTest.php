<?php

  namespace Funivan\Gallery\App\Photo;

  use Funivan\Gallery\FileStorage\File\File;
  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;
  use Funivan\Gallery\FileStorage\Fs\Memory\MemoryStorage;
  use PHPUnit\Framework\TestCase;

  class MetaInformationTest extends TestCase {


    public function testSet() {
      $file = new File(new LocalPath('/test/user--d.jpg'), new MemoryStorage());
      $file->write('test');
      $meta = new MetaInformation($file);
      $meta->set(MetaInformation::DELETED);

      self::assertSame(
        'test',
        $file->read()
      );
    }
  }
