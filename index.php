<?php
$request_uri = $_SERVER["REQUEST_URI"];

$base_dir = '/php-mvc-project';
// Check if the base directory is present in the URI
if (strpos($request_uri, $base_dir) === 0) {
    // Remove the base directory from the URI
    $request_uri = substr($request_uri, strlen($base_dir));
}
// Parse the modified URI
$path = parse_url($request_uri, PHP_URL_PATH);

// Autoload Class
spl_autoload_register(function (string $className) {
  $baseDir = __DIR__ . '/src/';

  // Convert class name to file path format
  $filePath = $baseDir . str_replace('\\', '/', $className) . '.php';
  // Check if the file exists
  if (file_exists($filePath)) {
      // Load the class file
      require $filePath;
  }
});


$router = new Core\Router;
$router->add("/category/{slug:[\w-]+}", ["controller" => "category", "action" => "show"]);
$router->add("/{controller}/{action}/{id:\d+}");
$router->add("/", ["controller" => "home", "action" => "index"]);
$router->add("/home/index", ["controller" => "home", "action"=>"index"]);
$router->add("/category/", ["controller" => "category", "action"=>"index"]);
$router->add("/category/index", ["controller" => "category", "action"=>"index"]);
$router->add("/category/show");
$router->add("/{controller}/{action}");




$dispatcher = new Core\Dispatcher($router);
$dispatcher->handle($path);