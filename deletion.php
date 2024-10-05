<?php 
require 'dbConfig.php';                                             // dbConfig of course

if ($_SERVER["REQUEST_METHOD"] == "POST") {                         // Check if form is submitted
    $recordId = $_POST['record_id'] ?? null;                        // Get the record ID for deletion
    $table = $_POST['table'] ?? null;                               // Selected table

    $allowed_Tables = ['Users', 'Books', 'Checkout', 'Reviews']; // Deliveries cannot be deleted since it is very important

    if ($table === 'Users') {
        $delete_Key = 'User_id';
    } elseif ($table === 'Books') {
        $delete_Key = 'Book_id';
    } elseif ($table === 'Checkout') {
        $delete_Key = 'Checkout_id';
    } elseif ($table === 'Reviews') {
        $delete_Key = 'Review_id';
    } else {
        echo "Unavailable option. Try again.";
    }
    
    $delete_Sql = "DELETE FROM $table WHERE $delete_Key = ?";  // sql query to delete

    try {
        $stmt = $pdo->prepare($delete_Sql);  // Prepare the delete query
        $stmt->execute([$recordId]);  // Execute the query with the record ID
        echo "Record deleted successfully from $table";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Select an option";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Record</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <div class="container"> 
        <h1>Delete a Record</h1>

        <form action="" method="post">
            <label for="table">Select Table:</label>
            <select id="table" name="table" required>
                <option value="Users">Users</option>
                <option value="Books">Books</option>
                <option value="Checkout">Checkout</option>
                <option value="Reviews">Reviews</option>
            </select> <br><br>
            
            <label for="record_id">Record ID:</label>
            <input type="number" id="record_id" name="record_id" required> <br><br>

            <input type="submit" value="Delete Record">
        </form>

        <!-- return to menu -->
        <form action="index.php" method="get">
            <button type="menu">RETURN TO MENU</button>
        </form>
    </div>
</body>
</html>
