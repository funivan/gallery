<?php
  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Photo;

  use Funivan\Gallery\App\Photo\Flag\Flags;
  use Funivan\Gallery\App\Photo\Flag\FlagsInterface;
  use Funivan\CabbageFs\File\File;
  use Funivan\CabbageFs\Fs\Local\LocalPath;
  use Funivan\CabbageFs\Fs\Memory\MemoryStorage;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  class MetaInformationTest extends TestCase {


    public function testSet(): void {
      $file = new File(new LocalPath('/test/user.jpg'), new MemoryStorage());
      $file->write('test');
      $newFile = (new Flags($file))->set(FlagsInterface::DELETED);
      self::assertSame(
        'user--d.jpg',
        $newFile->path()->name()
      );
    }
  }
