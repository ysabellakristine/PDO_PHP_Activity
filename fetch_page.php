<?php
require 'dbConfig.php'; // Include the database configuration

// Initialize an empty array for the tables
$stmt = $pdo->query("SHOW TABLES");
$tables = $stmt->fetchAll(PDO::FETCH_COLUMN); // Fetch all table names

$results = []; // Initialize results
$errorMessage = ''; // Initialize error message

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['table'])) {
    $table = $_POST['table']; // Get selected table from the form

    if ($table === 'Fetch All Data') {
        // Fetch all data from all tables
        foreach ($tables as $tableName) {
            $stmt = $pdo->prepare("SELECT * FROM `$tableName`");
            $stmt->execute();
            $results[$tableName] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    } elseif ($table === 'Fetch Random Data') {
        // Fetch a random row from a selected table
        echo "<h2>Select a Table for Random Data:</h2>";
        echo "<form action='page.php' method='post'>"; // Ensure this action points to the correct script
        echo "<select name='table' required>";
        echo "<option value=''>--Select a table--</option>";
        foreach ($tables as $tableName) {
            echo "<option value='" . htmlspecialchars($tableName) . "'>" . htmlspecialchars($tableName) . "</option>";
        }
        echo "</select>";
        echo "<button type='submit'>Get Random Data</button>";
        echo "</form>";
        exit; // Exit to avoid executing the rest of the script
    } elseif (in_array($table, $tables)) {
        // Fetch data from the selected table
        $stmt = $pdo->prepare("SELECT * FROM `$table` ORDER BY RAND() LIMIT 1"); // Fetch a random row
        $stmt->execute(); // Execute the prepared statement
        $results[$table] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Check if results are empty
        if (empty($results[$table])) {
            $errorMessage = "No data found in the selected table: " . htmlspecialchars($table);
        }
    } else {
        $errorMessage = "<p>Invalid table name specified.</p>"; // Error message for invalid table name
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetch() Demo)</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <div class="container"> <!-- Container for results -->
    <h1>Fetch Data from Database</h1>
    <form action="demo_fetch.php" method="post"> <!-- Change to page.php -->
        <label for="table">Select option</label>
        <select name="table" id="table" required>
            <option value="">-- Select a table --</option>
            <option value="Fetch All Data">Fetch All Data</option> <!-- Option for fetching all tables -->
            <?php foreach ($tables as $tableName): ?>
                <option value="<?php echo htmlspecialchars($tableName); ?>"><?php echo htmlspecialchars($tableName); ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Fetch Data</button>
    </form>
    <!-- return to menu -->
    <br> <br>
    <form action="index.php" method="get">
    <button type="menu">RETURN TO MENU</button>
    </form>

</div>
</body>
</html>
