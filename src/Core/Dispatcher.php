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

    $controller = $params["controller"];
    $controllerClassName = "App\Controllers\\" . ucfirst($controller) . "Controller";
    $action = $params["action"];

    $parameter = $this->getActionArguments($controllerClassName,$action, $params);
    echo $parameter;

    $controller_object = new $controllerClassName;
    $controller_object->$action();
  }

  private function getActionArguments($controllerClassName, $action, $params) {
    $agrs = [];
    $method = new ReflectionMethod($controllerClassName, $action);
    foreach ($method->getParameters() as $parameter) {
      
    }
  }
}