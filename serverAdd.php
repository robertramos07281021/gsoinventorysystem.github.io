<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "gsoinventory";

// Connection to the database
$connection = new mysqli($servername, $username, $password, $database);

$item_name = $dep_names = $property_code = $quantity = $end_user = $description = "";

$errorMessage = $successMessage = "";

// Retrieve department names from the database
$dep_names = array();
$sql = "SELECT dep_name, dep_name FROM department"; // Corrected column name: dep_name
$result = $connection->query($sql);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $dep_names[$row['dep_name']] = $row['dep_name']; // Use dep_name as the array key, and use dep_name as the value
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_name = $_POST["item_name"];
    $dep_name = $_POST["dep_names"]; // Use dep_name as the selected value
    $property_code = $_POST["property_code"];
    $quantity = $_POST["quantity"];
    $end_user = $_POST["end_user"];
    $description = $_POST["description"];

    if (empty($item_name) || empty($dep_name) || empty($property_code) || empty($quantity) || empty($end_user) || empty($description)) {
        $errorMessage = "All fields are required";
    } else {
        // Add new item to the database
       // Add new item to the database with the current timestamp for created_at
        $sql = "INSERT INTO items (item_name, dep_name, property_code, quantity, end_user, description, created_at) " .
        "VALUES ('$item_name','$dep_name','$property_code','$quantity','$end_user','$description', NOW())";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
        } else {
            $successMessage = "Item added correctly";
            // Redirect to a success page
            header("Location: items_page.php");
            exit;
        }
    }
}
?>