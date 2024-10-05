<?php 
require 'dbconfig.php';                                                         // walang kamatayang dbConfig huhu

if ($_SERVER["REQUEST_METHOD"] == "POST") {                                     // check if form is submitted
    // Determine which table to insert into
    $table = $_POST['table'] ?? '';                                             // Use null coalescing to avoid undefined index 

    if ($table === 'Users') {                                                   // Check if the required fields are set before accessing them
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;
        $email = $_POST['email'] ?? null;
        $address = $_POST['address'] ?? null;

        if ($username && $password && $email) {                                                   // Use && so it would only work if all required fields are filled
            $sql = "INSERT INTO Users (Username, Password, Email, Address) VALUES (?, ?, ?, ?)"; // sql query for insertion
            
            try {
                $stmt = $pdo->prepare($sql);                                // prepare statement for safety
                $stmt->execute([$username, $password, $email, $address]); // Execute with user data
                echo "New user created successfully";
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "Please fill in all required fields for Users.";
        }
    } elseif ($table === 'Books') {
        $title = $_POST['title'] ?? null;
        $author = $_POST['author'] ?? null;
        $genre = $_POST['genre'] ?? null;
        $isbn = $_POST['isbn'] ?? null;
        $book_status = $_POST['book_status'] ?? null;
        $borrow_price = $_POST['borrow_price'] ?? null;
        $stock_available = $_POST['stock_available'] ?? null;

        if ($title && $author && $isbn && $book_status && $borrow_price && $stock_available) { // Use && so it would only work if all required fields are filled
            $sql = "INSERT INTO Books (Title, Author, Genre, ISBN, Book_Status, Borrow_Price, Stock_Available) VALUES (?, ?, ?, ?, ?, ?, ?)";
            
            try {
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$title, $author, $genre, $isbn, $book_status, $borrow_price, $stock_available]); // Execute with book data
                echo "New book added successfully";
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            } 
    } 
        } else {
            echo "Please fill in all required fields for Books.";
        }
    }
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
    <h1>Insert Data</h1>

    <form action="" method="post">
        <label for="table">Select Table:</label>
        <select id="table" name="table" required>
            <option value="">Select...</option>
            <option value="Users">Users</option>
            <option value="Books">Books</option>
        </select>
        <input type="submit" value="Select">
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($table)): ?>
        <?php if ($table === 'Users'): ?>
            <h2>User Information</h2>
            <form action="" method="post">
                <input type="hidden" name="table" value="Users">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <br><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <br><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <br><br>
                <label for="address">Address:</label>
                <textarea id="address" name="address"></textarea>
                <br><br>
                <input type="submit" value="Insert User">
            </form>
        <?php elseif ($table === 'Books'): ?>
            <h2>Book Information</h2>
            <form action="" method="post">
                <input type="hidden" name="table" value="Books">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
                <br><br>
                <label for="author">Author:</label>
                <input type="text" id="author" name="author" required>
                <br><br>
                <label for="genre">Genre:</label>
                <input type="text" id="genre" name="genre" required>
                <br><br>
                <label for="isbn">ISBN:</label>
                <input type="text" id="isbn" name="isbn" required>
                <br><br>
                <label for="book_status">Book Status:</label>
                <input type="text" id="book_status" name="book_status" required>
                <br><br>
                <label for="borrow_price">Borrow Price:</label>
                <input type="number" step="0.01" id="borrow_price" name="borrow_price" required>
                <br><br>
                <label for="stock_available">Stock Available:</label>
                <input type="number" id="stock_available" name="stock_available" required>
                <br><br>
                <input type="submit" value="Insert Book">
            </form>
        <?php endif; ?>
        <!-- return to menu -->
        <form action="index.php" method="get">
        <button type="menu">RETURN TO MENU</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>
