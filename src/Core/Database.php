<?php
namespace Core;
use PDO;
use Phar;

class Database {
  private string $hostname;
  private string $username;
  private string $password;
  private string $database;
  private string $port;


  public function __construct(string $hostname,
                              string $username,
                              string $password,
                              string $database,
                              string $port)
  {
    $this->hostname = $hostname;
    $this->username = $username;
    $this->password = $password;
    $this->database = $database;
    $this->port = $port;

  }
  public function getConnection(): PDo {
    $dsn = "mysql:host=$this->hostname;dbname=$this->database;charset=utf8;port=$this->port";

    return new PDO($dsn, "root", $this->password,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
  }
}