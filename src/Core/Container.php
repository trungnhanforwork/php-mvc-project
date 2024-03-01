<?php
namespace Core;

use Closure;
use ReflectionClass;



class Container {

  public array $registry = [];

  public function set($name, Closure $value) : void {
    $this->registry[$name] = $value;
  }

  public function get(string $className) : object {
    if (array_key_exists($className, $this->registry)) {
      return $this->registry[$className]();
    }
    $reflector = new ReflectionClass($className);
    $constructor = $reflector->getConstructor();
    $dependencies = []; 
    if ($constructor === null) {
      return new $className;
    }

    foreach ($constructor->getParameters() as $parameter) {
        //Get type of instance
        $type = (string) $parameter->getType();
        

        $dependencies[] = $this->get($type);
      }
    return new $className(...$dependencies);
    
  }
}