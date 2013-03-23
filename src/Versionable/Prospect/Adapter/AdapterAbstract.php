<?php

namespace Versionable\Prospect\Adapter;

use Versionable\Prospect\Adapter\Exception\AdapterAbstractException;

abstract class AdapterAbstract
{
  private $options = array();

  /**
   * This function sets an option
   *
   * @param $name
   * @param $value
   */
  public function setOption($name, $value)
  {
    $this->options[$name] = $value;
  }

  /**
   * @return array
   */
  public function getOptions()
  {
    return $this->options;
  }

  /**
   * This function returns a boolean that denotes whether an option is set or not
   *
   * @param $name
   * @return bool
   */
  public function hasOption($name)
  {
    if(isset($this->options[$name])){
      return true;
    }

    return false;
  }

  /**
   * This function returns the value of a named option
   *
   * @param $name
   * @return mixed
   * @throws Exception\AdapterAbstractException
   */
  public function getOption($name)
  {
    if(!isset($this->options[$name])){
      throw new AdapterAbstractException(sprintf('The option %s was not set', $name));
    }

    return $this->options[$name];
  }
}
