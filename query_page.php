<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews Table</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <div class="container">
        <h1>SQL Query Execution</h1>
        <h2>Query: SELECT * FROM Books WHERE Genre = 'Horror'</h2>
        
        <table>
            <thead>
                <tr>
                    <th>Book ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>ISBN</th>
                    <th>Book Status</th>
                    <th>Borrow Price</th>
                    <th>Stock Available</th>
                </tr>
            </thead>
            <tbody>
                <!-- PHP code to fetch and display results -->
                <?php
                require 'dbConfig.php'; // Ensure you include the correct path to dbConfig.php
                
                // Execute query
                $sql = "SELECT * FROM Books WHERE Genre = 'Horror'";
                $result = $pdo->query($sql);

                // Display results
                if ($result) {
                    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>
                            <td>{$row['Book_id']}</td>
                            <td>{$row['Title']}</td>
                            <td>{$row['Author']}</td>
                            <td>{$row['Genre']}</td>
                            <td>{$row['ISBN']}</td>
                            <td>{$row['Book_Status']}</td>
                            <td>{$row['Borrow_Price']}</td>
                            <td>{$row['Stock_Available']}</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No results found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div> <br>
    <!-- return to menu -->
    <form action="index.php" method="get">
        <button type="menu">RETURN TO MENU</button>
    </form>
</body>
</html>
