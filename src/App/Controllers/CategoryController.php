<?php
namespace App\Controllers;
use \App\Models\Category;
use Core\Viewer;

class CategoryController {
  public function index() {
    // require "src/Models/Category.php";
    $category = new Category;
    $categories = $category->getData();
    $viewer = new Viewer;
    echo $viewer->render("shared/header.php");

    echo $viewer->render("Category/index.php", [
      "categories" => $categories
    ]);
  }

  public function show(string $id) {
    $viewer = new Viewer;
    echo $viewer->render("shared/header.php");
    echo $viewer->render("Category/show.php", [
      "id" => $id
    ]);
  }
}