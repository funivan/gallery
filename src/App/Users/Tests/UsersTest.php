<?php
  declare(strict_types = 1);

  namespace Funivan\Gallery\App\Users\Tests;

  use Funivan\Gallery\App\Users\Users;
  use Funivan\CabbageFs\File\File;
  use Funivan\CabbageFs\Fs\Local\LocalPath;
  use Funivan\CabbageFs\Fs\Memory\MemoryStorage;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  final class UsersTest extends TestCase {

    public function testValidatePassword(): void {
      $file = File::create(new LocalPath('test.json'), new MemoryStorage());
      $file->write(
      /** @lang JSON */
        '{"users":{"ivan":{"pass":123, "rules":[12,42]}}}'
      );
      $users = new Users($file);
      $user = $users->get('ivan');
      self::assertTrue($user->validatePassword('123'));
      self::assertFalse($user->validatePassword('122'));
    }

  }
