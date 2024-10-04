<?php
require 'dbConfig.php'; // Requires the database configuration

$table = isset($_POST['table']) ? $_POST['table'] : null;  // denotes table as well as checks if the table name is valid, if so it assigns table variable
$stmt = $pdo->query("SHOW TABLES");                        // uses PDO to do sql query of SHOW TABLES, SHOW TABLES = instantly lists all tables in database in one column
$tables = $stmt->fetchAll(PDO::FETCH_COLUMN);              // PDO::FETCH_COLUMN gets all items from first column, so it gets the table names

$results = [];                                              // initialize results

if ($table) {                                               // check if the table variable is set
    if ($table == 'Fetch All Data') {                       // fetch all data from all tables
        try {
            foreach ($tables as $tableName) {  
                if (in_array($tableName, $tables)) { 
                    $stmt = $pdo->query("SELECT * FROM `$tableName`"); 
                    $results[$tableName] = $stmt->fetchAll();
                }
            }
        } catch (PDOException $e) {
            echo "Error fetching data: " . htmlspecialchars($e->getMessage()); // Error handling
        }
    } elseif (in_array($table, $tables)) {              // Fetch data from the selected table
        try {
            $stmt = $pdo->query("SELECT * FROM `$table`"); 
            $results[$table] = $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error fetching data: " . htmlspecialchars($e->getMessage()); // Error handling
        }
    } else {
        echo "Invalid table name specified.";                           // Error message uwu
    }
} else {
    echo "No table specified.";                                         // in case na walang specified na table
}

if (!empty($results)) {                                                 // Display results
    echo "<h2>Data from Tables:</h2>";
    foreach ($results as $tableName => $data) {
        echo "<h3>" . htmlspecialchars($tableName) . "</h3>";
        echo "<pre>" . print_r($data, true) . "</pre>"; // Use print_r w/ <pre> in between
    }
} else {
    echo "No data found.";
}
?>
