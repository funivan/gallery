<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\FileStorage\Tests\Fs\Local;

  use Funivan\Gallery\FileStorage\Fs\Local\LocalFsStorage;
  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;
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

  }
