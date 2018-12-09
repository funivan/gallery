<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Router\RegexRoute;

  use Funivan\CabbageFramework\Http\Request\ParametersInterface;
  use Funivan\CabbageFramework\Router\UrlInterface;

  /**
   *
   */
  class RegexRouteBuilder implements UrlInterface {

    /**
     * @var string
     */
    private $regex;

    /**
     * @var ParametersInterface
     */
    private $parameters;


    /**
     * @param string $regex
     * @param ParametersInterface $parameters
     */
    public function __construct(string $regex, ParametersInterface $parameters) {
      $this->regex = $regex;
      $this->parameters = $parameters;
    }


    /**
     * @todo take a look: Complicated code
     * Create url from the parameters
     * @return string
     */
    final public function build(): string {
      $path = $this->regex;
      $usedParameters = [];
      /** @noinspection HtmlUnknownTag */
      $path = preg_replace_callback('/\(\?\<(?<name>[a-z]+)\>[^)]+\)/', function ($match) use (&$usedParameters) {
        $name = (string) $match['name'];
        $value = $this->parameters->value($name);
        $usedParameters[$name] = true;
        return $value;
      }, $path);
      $additionalParameters = $this->parameters->all();
      foreach ($additionalParameters as $name => $parameter) {
        if (array_key_exists($name, $usedParameters)) {
          unset($additionalParameters[$name]);
        }
      }
      if (count($additionalParameters) > 0) {
        $path = $path . '?' . http_build_query($additionalParameters);
      }
      return $path;
    }
  }