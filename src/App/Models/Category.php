<?php
namespace App\Models;
use PDO;
class Category {
  public function getData() {
    $dsn = "mysql:host=localhost;dbname=lms;charset=utf8;port=3306";

    $pdo = new PDO($dsn, "root", "mysql",[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    $stmt = $pdo->query("Select * from categories");

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  } 
}