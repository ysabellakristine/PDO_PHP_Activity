<?php 
require 'dbconfig.php';  // Include your database configuration

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selected_review_id = $_POST['review_id'];
    $comment = $_POST['comment']; // Get the comment input
    
    // Update the review in the database
    $stmt = $pdo->prepare("UPDATE Reviews SET Comment = :comment WHERE Review_id = :review_id");
    
    // Bind parameters
    $stmt->bindParam(':comment', $comment);
    $stmt->bindParam(':review_id', $selected_review_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Review ID: " . htmlspecialchars($selected_review_id) . " has been updated successfully.";
    } else {
        echo "Error updating review: " . $pdo->errorInfo()[2]; // Display the error message
    }
}

// Retrieve reviews for the dropdown
$reviews = $pdo->query("SELECT Review_id FROM Reviews");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Data</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <div class="container"> 
        <h1>Update Reviews</h1>
        <form action="" method="post">
            <label for="review_id">Select Review ID:</label>
            <select name="review_id" id="review_id" required>
                <?php
                if ($reviews->rowCount() > 0) {
                    // Output data of each row
                    while ($row = $reviews->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . htmlspecialchars($row['Review_id']) . "'>" . htmlspecialchars($row['Review_id']) . "</option>";
                    }
                } else {
                    echo "<option value=''>No reviews available</option>";
                }
                ?>
            </select>

            <br><br>

            <label for="comment">Update Review:</label>
            <input type="text" id="comment" name="comment" required>
            <input type="submit" value="Update Review">
        </form>

        <!-- Return to menu -->
        <form action="index.php" method="get">
            <button type="menu">RETURN TO MENU</button>
        </form>
    </div>
</body>
</html>
