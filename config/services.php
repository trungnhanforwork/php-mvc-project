<?php

use Core\Database;

$container = new Core\Container;

$container->set(Core\Database::class, function() {
  return new Database("localhost","root","mysql", "lms", "3306");
});

return $container;