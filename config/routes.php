<?php
$router = new Core\Router;

$router->add("/home/index", ["controller" => "home", "action"=>"index"]);
$router->add("/category", ["controller" => "category", "action"=>"index"]);
$router->add("/category/index", ["controller" => "category", "action"=>"index"]);
$router->add("/category/show",["controller" => "category", "action"=>"show"]);
$router->add("/category/{slug:[\w-]+}", ["controller" => "category", "action" => "show"]);
$router->add("/{controller}/{action}/{id:\d+}");
$router->add("/admin/{controller}/{action}",["namespace" => "Admin"]);
$router->add("/", ["controller" => "home", "action" => "index"]);

$router->add("/{controller}/{action}");
return $router;