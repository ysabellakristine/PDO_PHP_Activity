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
            $stmt = $pdo->query("SELECT * FROM `$tableName`");
            $results[$tableName] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    } elseif (in_array($table, $tables)) {
        // Fetch data from the selected table
        $stmt = $pdo->prepare("SELECT * FROM `$table`");
        $stmt->execute(); // Execute the prepared statement
        $results[$table] = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <h1>Select a Table to Fetch Data</h1>

    <!-- Form to select a table -->
    <form action="demo_fetchall.php" method="post"> <!-- Ensure action is pointing to the same page -->
        <label for="table">Choose a table:</label>
        <select name="table" id="table" required>
            <option value="">-- Select a table --</option>
            <option value="Fetch All Data">Fetch All Data</option> <!-- Option for fetching all tables -->
            <?php foreach ($tables as $tableName): ?>
                <option value="<?php echo htmlspecialchars($tableName); ?>"><?php echo htmlspecialchars($tableName); ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Fetch Data</button>
    </form>

    <?php if (!empty($results)): ?>
        <h2>Data from Tables:</h2>
        <?php foreach ($results as $tableName => $data): ?>
            <h3><?php echo htmlspecialchars($tableName); ?></h3>
            <?php if (empty($data)): ?>
                <p>No data available in this table.</p>
            <?php else: ?>
                <pre><?php print_r($data); ?></pre>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No results to display. Please select a table and fetch data.</p>
    <?php endif; ?>
</body>
</html>
