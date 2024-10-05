<?php
require 'dbConfig.php'; // Include the database configuration

// Initialize an empty array for the tables
$stmt = $pdo->query("SHOW TABLES");
$tables = $stmt->fetchAll(PDO::FETCH_COLUMN); // Fetch all table names

$results = []; // Initialize results

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['table'])) {
    $table = $_POST['table']; // Get selected table from the form

    if ($table === 'Fetch All Data') {
        // Fetch all data from all tables
        foreach ($tables as $tableName) {
            try {
                $stmt = $pdo->prepare("SELECT * FROM `$tableName`");
                $stmt->execute(); // Execute the prepared statement
                $results[$tableName] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "<p>Error fetching data from $tableName: " . htmlspecialchars($e->getMessage()) . "</p>";
            }
        }
    } elseif (in_array($table, $tables)) {
        // Fetch data from the selected table
        try {
            $stmt = $pdo->prepare("SELECT * FROM `$table`");
            $stmt->execute(); // Execute the prepared statement
            $results[$table] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "<p>Error fetching data: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    } else {
        echo "<p>Invalid table name specified.</p>"; // Error message for invalid table name
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetch Data</title>
    <link rel="stylesheet" href="styles.css"> <!-- Reference to your CSS file -->
</head>
<body>
<div class="container"> 
    <h1>Fetchall() Demo</h1>
    <form action="demo_fetchall.php" method="post"> 
        <label for="table">Choose a table:</label>
        <select name="table" id="table" required>
            <option value="">-- Select a table --</option>
            <option value="Fetch All Data">Fetch All Data</option> 
            <?php foreach ($tables as $tableName): ?>
                <option value="<?php echo htmlspecialchars($tableName); ?>"><?php echo htmlspecialchars($tableName); ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Fetch Data</button>
    </form>

    <br> <br>
    <form action="index.php" method="get">
    <button type="menu">RETURN TO MENU</button>
    </form>

</div>
</body>
</html>
