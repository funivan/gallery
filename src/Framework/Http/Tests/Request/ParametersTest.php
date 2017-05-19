<?php

  namespace Funivan\Gallery\Framework\Http\Tests\Request;

  use Funivan\Gallery\Framework\Http\Request\Parameters;
  use PHPUnit\Framework\TestCase;

  /**
   * @codeCoverageIgnore
   */
  final class ParametersTest extends TestCase {

    public function testHas() {
      $parameters = new Parameters(['user' => '', 'id' => 123]);
      self::assertTrue($parameters->has('user'));
      self::assertTrue($parameters->has('id'));
      self::assertFalse($parameters->has('name'));
    }


    public function testValue() {
      $parameters = new Parameters(['user' => '', 'name' => true]);
      self::assertSame('1', $parameters->value('name'));
      self::assertSame('', $parameters->value('user'));

    }


    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Can not fetch parameter: surname
     */
    public function testInvalidValueAccess() {
      $parameters = new Parameters(['user' => '', 'name' => 'user name']);
      self::assertSame('user name', $parameters->value('name'));

      $parameters->value('surname');

    }


  }
