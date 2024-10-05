<?php
require 'dbConfig.php';                                    // Requires the database configuration

$table = isset($_POST['table']) ? $_POST['table'] : null;  // Check if the table name is valid, if so it assigns to table variable
$stmt = $pdo->query("SHOW TABLES");                        // Use PDO to do SQL query to list all tables in the database
$tables = $stmt->fetchAll(PDO::FETCH_COLUMN);              // Fetch all table names

$results = [];                                              // Initialize results

if ($table) {                                               // Check if the table variable is set
    if ($table == 'Fetch All Data') {                       // Fetch all data from all tables
        try {
            foreach ($tables as $tableName) {  
                $stmt = $pdo->query("SELECT * FROM `$tableName`"); 
                $results[$tableName] = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch as associative array
            }
        } catch (PDOException $e) {
            echo "Error fetching data: " . htmlspecialchars(string: $e->getMessage()); // Error handling
        }
    } elseif (in_array($table, $tables)) {              // Fetch data from the selected table
        try {
            $stmt = $pdo->query("SELECT * FROM `$table`"); 
            $results[$table] = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch as associative array
        } catch (PDOException $e) {
            echo "Error fetching data: " . htmlspecialchars($e->getMessage()); // Error handling
        }
    } else {
        echo "Invalid table name specified.";                           // Error message
    }
} else {
    echo "No table specified.";                                         // In case no table is specified
}
?>

<!DOCTYPE html>
<html lang="en"> --         <!-- formatting results -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetch Data</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <div class="container"> <!-- Container for results -->
    <br> <br>
    <form action="index.php" method="get">
        <button type="menu">RETURN TO MENU</button>
    </form>
        <?php if (!empty($results)) {                                                 // Display results
            echo "<h2>Data from Tables:</h2>";
            foreach ($results as $tableName => $data) {
                echo "<h2>" . htmlspecialchars($tableName) . "</h2>";
                echo "<pre>" . print_r($data, true) . "</pre>";          // Use print_r w/ <pre> in between
            }   
            
        } else {
            echo "No data found.";                                                      // Display message when there's no data
        }
        ?>
    </div> 
</body>
</html>
