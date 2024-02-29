<?php
namespace Core;
class Router {
  private array $routes = [];
  public function add(string $path, array $params = []) {
    $this->routes[] = [
      "path" => $path,
      "params" => $params
    ];
  }
  public function match(string $path)
    {
        $path = trim($path, "/");
        
        foreach ($this->routes as $route) {
            $pattern = $this->getPatternFromRoutePath($route["path"]);
            if (preg_match($pattern, $path, $matches)) {
                $matches = array_filter($matches, "is_string", ARRAY_FILTER_USE_KEY);
                $params = array_merge($matches, $route["params"]);
                return $params;
            }
        }

        return false;
    }

  /*
    If uri dont have route like $router->add("/category", ["controller" => "category", "action"=>"index"]); (1)
    We will check the uri match with some pattern we added like: $router->add("/{controller}/{action}/{id}");
    So method getPatternFromRoutePath will check the uri with 2 case above. 
      + If case (1) => $pattern will 
      + If case (2) => $pattern will be created correspond to the form we added
  */
  private function getPatternFromRoutePath(string $route_path): string
    {
        $route_path = trim($route_path, "/");

        $segments = explode("/", $route_path);


        $segments = array_map(function(string $segment): string {
            if (preg_match("#^\{([a-z][a-z0-9]*)\}$#", $segment, $matches)) {
              // matches return each group in ()
              return "(?<" . $matches[1] . ">[^/]+)";
            }
            if (preg_match("#^\{([a-z][a-z0-9]*):(.+)\}$#", $segment, $matches)) {
                return "(?<" . $matches[1] . ">". $matches[2] . "[^/]+)";
            }
            return $segment;
        }, $segments);

        return "#^" . implode("/", $segments) . "$#iu";
    }
}