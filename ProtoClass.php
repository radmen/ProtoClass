<?php
class ProtoClass {

  /**
   * @param array $classProperties if set all values will be stored as a object properties
   */
  public function __construct(array $classProperties = null) {
    
    if(null !== $classProperties) {
      
      foreach($classProperties as $name => $value) {
        $this->$name = $value;
      }
    }
  }
  
  /**
   * Try to execute a callback assigned to property of the same name.
   *
   * @param string $method
   * @param array $args 
   */
  public function __call($method, $args) {

    if(false === isset($this->$method)) {
      throw new LogicException('Call to undefined method');
    }

    $func = $this->$method;

    if(false === is_callable($func)) {
      throw new LogicException('Method is not callable');
    }

    // pass $this as first argument of callback
    array_unshift($args, $this);
    
    return call_user_func_array($func, $args);
  }
}