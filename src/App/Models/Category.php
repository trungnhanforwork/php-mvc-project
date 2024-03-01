<?php
namespace App\Models;

use Core\Database;
use PDO;
class Category {
  private Database $database;
  public function __construct(Database $database)
  {
    $this->database = $database;
  }
  public function getData() {
    $pdo = $this->database->getConnection();
    $stmt = $pdo->query("Select * from categories");

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  } 
}