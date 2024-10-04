<?php                                              // code is for inserting sql into database
require 'dbConfig.php';                           //uses the dbConfig.php file

try {
  $con = new PDO($dsn, $user, $password, $options); // creates PDO instance
  $sql = file_get_contents('database.sql');       // reads content of the database.sql file
  $conn->exec($sql);                              // executes sql statements within the file
  echo "Ayie na-insert yung SQL file na maayos"; // prints statement once completed
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();            // dito tayo iiyak
}
