<?php

namespace Core;
use Core\Exceptions\PageNotFoundException;
use ReflectionMethod;

class Dispatcher {
  private Router $router;
  private Container $container;
  public function __construct(Router $router, Container $container)
  {
    $this->router = $router;
    $this->container = $container;
  }

  public function handle(string $path) {
    $params = $this->router->match($path);
    if ($params === false) {
      throw new PageNotFoundException("No route matched with path: $path!");
    }
    // print_r($params);
    // exit("match");


    $controller = $this->getControllerName($params);  
    $action = $this->getActionName($params);

    $controller_object = $this->container->get($controller);
     
    $args = $this->getActionArguments($controller,$action, $params);
    // $args = array_values($args);
    call_user_func_array([$controller_object, $action], $args);
    
  }

  private function getActionArguments($controller, $action, $params): array {
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