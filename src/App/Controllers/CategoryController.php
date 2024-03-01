<?php
namespace App\Controllers;
use \App\Models\Category;
use Core\Viewer;

class CategoryController {
  private Viewer $viewer;
  private Category $category;
  public function __construct(Viewer $viewer, Category $category)
  {
    $this->viewer = $viewer;
    $this->category = $category;
  }
  public function index() {
    // require "src/Models/Category.php";
    // $category = new Category;
    $categories = $this->category->getData();
    
    echo $this->viewer->render("shared/header.php");

    echo $this->viewer->render("Category/index.php", [
      "categories" => $categories
    ]);
  }

  public function show(string $id) {
    
    echo $this->viewer->render("shared/header.php");
    echo $this->viewer->render("Category/show.php", [
      "id" => $id
    ]);
  }
}