<?php

  namespace Funivan\Gallery\App\Photo;

  use Funivan\Gallery\App\Photo\Flag\Flags;
  use Funivan\Gallery\App\Photo\Flag\FlagsInterface;
  use Funivan\Gallery\FileStorage\File\File;
  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;
  use Funivan\Gallery\FileStorage\Fs\Memory\MemoryStorage;
  use PHPUnit\Framework\TestCase;

  class MetaInformationTest extends TestCase {


    public function testSet() {
      $file = new File(new LocalPath('/test/user.jpg'), new MemoryStorage());
      $file->write('test');
      $newFile = (new Flags($file))->set(FlagsInterface::DELETED);
      self::assertSame(
        'user--d.jpg',
        $newFile->path()->name()
      );
    }
  }
