<?php 

$host = "localhost";                            // Host name for the server
$user = "root";                                 // Username needed to connect to the database, root is a default user
$password = "";                                 // Password needed to access the database, leaving it blank for easier access
$dbname = "library_delivery";                   // Database name
$dsn = "mysql:host={$host};dbname={$dbname}";   // Data Source Name (DSN) = contains info needed to access database

$options = [ 
    // ATTR_ERRMODE = error reporting mode, ERRMODE_EXCEPTION = Throws PDO exceptions.
    // If an error occurs, you get detailed error descriptions. 
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,    
    // ATTR_DEFAULT_FETCH_MODE = fetch mode, FETCH_ASSOC = returns results as an associative array.
    // Associative array returns column names as array keys. Removes the need to specify fetch mode with every query.
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    // ATTR_EMULATE_PREPARES = option that checks whether PDO uses emulated prepared statements or native prepared statements.
    // false = disables emulation; native prepared statements = handled directly by the database, safer than emulated ones.
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try { 

    $pdo = new PDO("mysql:host=$host", $user, $password, $options); // Connect to the server, not the database yet
    $pdo->exec("SET time_zone = '+08:00';");                                               // Sets timezone for database

    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname`");   // Create the database if it doesn't exist
    $pdo->exec("USE `$dbname`");                             // Select the database
  
    if (file_exists('schema.sql')) {
        $schema = file_get_contents('schema.sql');  // Reads content of the schema.sql file
        $pdo->exec($schema);                      // Executes SQL statements to create tables
        $sqlconnection_Message = "Ayos na tables natin.<br>";                     // Prints statement once completed
    } else {
        $sqlconnection_Message ="Schema file not found.<br>";
    }

    if (file_exists('database.sql')) {
        $data = file_get_contents('database.sql');    // Reads content of the database.sql file
        $pdo->exec($data);                          // Executes SQL statements within the file
        $dbconnection_Message = "Ayie na-insert yung SQL file na maayos.<br>";     // Prints statement once completed
    } else {
        $dbconnection_Message = "Database file not found.<br>";
    }

} catch (PDOException $e) {
    $dbconnection_Message = "Data insertion failed: " . $e->getMessage();          // Error handling
}
