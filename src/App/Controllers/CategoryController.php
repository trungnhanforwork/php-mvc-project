<?php
namespace App\Controllers;
use \App\Models\Category;
class CategoryController {
  public function index() {
    // require "src/Models/Category.php";
    $category = new Category;
    $categories = $category->getData();
    require "Views/CategoryIndex.php";
  }

  public function show(string $id) {
    
    require "Views/CategoryShow.php";
  }
}