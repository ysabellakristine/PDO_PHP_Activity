<?php
// insert.php, removed to combine with dbConfig 
?>

<?php
require 'dbConfig.php';  // Uses the dbConfig.php file

try {
    $conn = new PDO($dsn, $user, $password, $options); // Creates PDO instance

    // Reading and executing schema.sql
    if (file_exists('schema.sql')) {
        $schemaSql = file_get_contents('schema.sql');   // Reads content of the schema.sql file
        $conn->exec($schemaSql);                        // Executes SQL statements to create tables
        echo "Ayos na tables natin.";                     // Prints statement once completed
    } else {
        echo "Schema file not found.";
    }

    // Reading and executing database.sql
    if (file_exists('database.sql')) {
        $datasql = file_get_contents('database.sql');   // Reads content of the database.sql file
        $conn->exec($datasql);                          // Executes SQL statements within the file
        echo "Ayie na-insert yung SQL file na maayos";  // Prints statement once completed
    } else {
        echo "Database file not found.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();                 // Error handling
}

<?php
// checkConnection.php, removed because my head hurt too much trying to understand it thanks.
?>

<?php 
require_once 'dbConfig.php';

if (!file_exists('checkConnection.php')) {
    die('Connection check file not found.');
}

list($dbconnection_Message, $cssClass) = include('checkConnection.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Connection</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>

<div class="connection-message <?php echo htmlspecialchars($cssClass); ?>"> 
    <?php echo htmlspecialchars($dbconnection_Message); ?>
</div>

</body>
</html>


