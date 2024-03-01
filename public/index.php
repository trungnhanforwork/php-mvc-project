<?php

use Core\Database;

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

$router = require "config/routes.php";
$container = require "config/services.php";
$dispatcher = new Core\Dispatcher($router, $container);
$dispatcher->handle($path);