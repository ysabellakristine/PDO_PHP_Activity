<?php 

$host = "localhost"; // host name for server
$user = "root"; // username needed to connect to database, root is default user probably
$password = ""; // password needed to access the database, leaving it blank for easier access but normally it has a password
$dbname = "libray_delivery"; // database name
$dsn = "mysql:host={$host};dbname={$dbname}"; // data source name = contains info needed to access database

$conn = new PDO($dsn, $user, $password); // creates a PDO
$conn->exec("SET time_zone = '+08:00';"); //sets timezone for database

//error handling eme
$options = [ 
  // ATTR_ERRMODE = error reporting mode, ERRMODE_EXCEPTION = Throws PDO exceptions. If an error occurs, you get detailed error descriptions. 
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,    
  // ATTR_DEFAULT_FETCH_MODE = fetch mode,   FETCH_ASSOC = returns results as an associative array, associative array returns column names as array keys. Removes the need to specify fetch mode with every query
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  // ATTR_EMULATE_PREPARES = option that checks whether PDO uses emulated prepared statements or native prepared statements, false = disables emulation
  // native prepared statements = handled directly by the database, uses SQL.  emulated prepared statements = handled by PDO or PHP script
  PDO::ATTR_EMULATE_PREPARES   => false,
  ];

// CHECKING CONNECTIONS
try { 
  $conn = new PDO($dsn, $user, $password);
  echo "Connected successfully!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();}

