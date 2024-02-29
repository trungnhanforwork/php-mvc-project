<?php
namespace App\Controllers;
use Core\Viewer;
class HomeController {
  public function index() {
    $viewer = new Viewer;
    $viewer->render("Home/index.php");
  }
}