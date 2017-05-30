<?php

  declare(strict_types=1);

  namespace Funivan\Gallery\Framework\DataStructures\ParsedString;

  /**
   *
   */
  class ParsedString {


    /**
     * @var string
     */
    private $input;

    /**
     * @var string
     */
    private $regexp;


    /**
     * @param string $input
     * @param string $regexp
     */
    public function __construct(string $input, string $regexp) {
      $this->input = $input;
      $this->regexp = $regexp;
    }


    /**
     * @param string $token
     * @param string $value
     * @return ParsedString
     */
    public function with(string $token, string $value): ParsedString {
      /** @var array $data */
      preg_match($this->regexp, $this->input, $data);
      $newInput = '';
      if (!array_key_exists($token, $data)) {
        throw new \RuntimeException(sprintf('Can not match token "%s" in the input string', $token));
      }
      $data[$token] = $value;
      foreach ($data as $name => $oldValue) {
        if (!is_numeric($name)) {
          $newInput = $newInput . $oldValue;
        }
      }
      return new self($newInput, $this->regexp);
    }


    /**
     * @param string $token
     * @return ParsedString
     */
    public function without(string $token): ParsedString {
      return $this->with($token, '');
    }


    /**
     * @param string $token
     * @return bool
     */
    public function has(string $token): bool {
      preg_match($this->regexp, $this->input, $data);
      return array_key_exists($token, $data);
    }


    /**
     * @return string
     */
    public function value(): string {
      return $this->input;
    }

  }