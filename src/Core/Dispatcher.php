<?php
use ReflectionMethod;
namespace Core;

use ReflectionMethod;

class Dispatcher {
  private Router $router;
  public function __construct(Router $router)
  {
    $this->router = $router;
  }

  public function handle(string $path) {
    $params = $this->router->match($path);
    if ($params === false) {
      exit("No route matched!");
    }
    // print_r($params);
    // exit("match");


    $controller = $this->getControllerName($params);  
    $action = $this->getActionName($params);
    

    // exit($controller . "</br>" . $action);
    $agrs = $this->getActionArguments($controller,$action, $params);
    $controller_object = new $controller;
    $controller_object->$action(...$agrs);
  }

  private function getActionArguments($controller, $action, $params) {
    $agrs = [];
    $method = new ReflectionMethod($controller, $action);
    foreach ($method->getParameters() as $parameter) {
      $name = $parameter->getName();
      $agrs[$name] = $params[$name];
    }
    return $agrs;
  }

  private function getControllerName($params) {
    $controller = $params["controller"];
    $controller = str_replace("-","",ucwords(strtolower($controller), "-")) . "Controller";
    $namespace = "App\Controllers";
    if (array_key_exists("namespace", $params)) {
      $namespace .= "\\" . $params["namespace"]; 
    }
    return $namespace . "\\". $controller; 
  }
  private function getActionName($params) {
    $action = $params["action"];
    $action = lcfirst(str_replace("-","",ucwords($action, "-")));
    return $action; 
  }
}