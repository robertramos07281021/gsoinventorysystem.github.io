<?php
if (isset($_GET["id"])) {
    $id = $_GET['id'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "gsoinventory";

    // Connect to the database
    $connection = new mysqli($servername, $username, $password, $database);

    // Delete the item from the database
    $sql = "DELETE FROM items WHERE id = ?";
    $statement = $connection->prepare($sql);
    $statement->bind_param("i", $id);
    $statement->execute();
    $statement->close();

    // Reset the auto-increment value for the "id" column
    $resetSql = "ALTER TABLE items AUTO_INCREMENT = 1";
    $result = $connection->query($resetSql);

    if (!$result) {
        die("Invalid query: " . $connection->error);
    }

    // Close the database connection
    $connection->close();
}

// Redirect back to the list of items (Item.php) after deletion and resetting the ID count
header("Location: Items_page.php");
exit;
?>
