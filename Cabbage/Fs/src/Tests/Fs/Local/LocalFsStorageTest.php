<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFs\Tests\Fs\Local;

  use Funivan\CabbageFs\Fs\Local\LocalFsStorage;
  use Funivan\CabbageFs\Fs\Local\LocalPath;
  use Funivan\CabbageFs\Fs\Local\Operation\DirectoryAutomaticCreation;
  use PHPUnit\Framework\TestCase;

  class LocalFsStorageTest extends TestCase {

    public function testWriteRead() {
      $fs = LocalFsStorage::create(new LocalPath(sys_get_temp_dir()));
      $fs->write(new LocalPath('test.txt'), 'data-file');
      self::assertSame(
        'data-file',
        $fs->read(new LocalPath('test.txt'))
      );
    }


    public function testMeta() {
      $fs = LocalFsStorage::create(new LocalPath(sys_get_temp_dir()));
      $path = new LocalPath('custom-file.json');
      $fs->write($path, '');
      self::assertSame(
        'json',
        $fs->meta($path, 'extension')
      );
    }


    public function testFind() {
      $fs = LocalFsStorage::createWithDirectoryCheck(
        new LocalPath(sys_get_temp_dir()),
        new DirectoryAutomaticCreation()
      );
      $dir = microtime(true);
      $filePath = new LocalPath('/test/' . $dir . '/my-doc.txt');
      $fs->write($filePath, 'doc');
      $files = [];
      foreach ($fs->finder(new LocalPath('/test/' . $dir))->items() as $path) {
        $files[] = $path->assemble();
      }
      self::assertSame([$filePath->assemble()], $files);
    }

  }
