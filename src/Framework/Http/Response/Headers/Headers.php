<?php

  declare(strict_types = 1);

  namespace Funivan\Gallery\Framework\Http\Response\Headers;

  use Funivan\Gallery\Framework\Http\Response\Headers\Exceptions\OverwriteHeaderFieldException;
  use Funivan\Gallery\Framework\Http\Response\HeadersInterface;

  /**
   *
   */
  class Headers implements HeadersInterface {

    /**
     * @var FieldInterface[]
     */
    private $fields;


    /**
     * @param FieldInterface[] $fields
     */
    public function __construct(array $fields) {
      $this->fields = $fields;
    }


    /**
     * @return FieldInterface[]
     */
    final public function fields(): array {
      return $this->fields;
    }


    /**
     * @param HeadersInterface $headers
     * @return HeadersInterface
     * @throws OverwriteHeaderFieldException
     */
    final public function merge(HeadersInterface $headers): HeadersInterface {
      $fieldsByName = [];
      foreach ($this->fields() as $field) {
        $fieldsByName[$field->name()] = $field;
      }
      foreach ($headers->fields() as $field) {
        if (array_key_exists($field->name(), $fieldsByName)) {
          throw new OverwriteHeaderFieldException(
            sprintf('Header field %s is already defined', $field->name())
          );
        }
        $fieldsByName[$field->name()] = $field;
      }
      return new Headers(array_values($fieldsByName));
    }


    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool {
      $has = false;
      foreach ($this->fields as $field) {
        if ($field->name() === $name) {
          $has = true;
        }
      }
      return $has;
    }


    /**
     * @param string $name
     * @return FieldInterface
     */
    public function field(string $name): FieldInterface {
      foreach ($this->fields as $field) {
        if ($field->name() === $name) {
          return $field;
        }
      }
      throw new \InvalidArgumentException(
        sprintf('Field with name "%s" does not exists', $name)
      );
    }

  }