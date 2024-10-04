<?php                                                // code is for inserting sql into database
require 'dbConfig.php';                             //uses the dbConfig.php file

try {
  $conn = new PDO($dsn, $user, $password, $options); // creates PDO instance

   $schemaSql = file_get_contents('schema.sql');    // reads content of the schema.sql file
   $conn->exec($schemaSql);                         // executes SQL statements to create tables
   echo "Ayos na tables natin.";                    // prints statement once completed

  $datasql = file_get_contents('database.sql');     // reads content of the database.sql file
  $conn->exec($sql);                                // executes sql statements within the file
  echo "Ayie na-insert yung SQL file na maayos";    // prints statement once completed
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();                // dito tayo iiyak
}
