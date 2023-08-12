<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "gsoinventory";

// Connect to the database
$connection = new mysqli($servername, $username, $password, $database);

$item_name = "";
$dep_name = "";
$property_code = "";
$end_user = "";
$description = "";

$errorMessage = "";
$successMessage = "";

// Retrieve department names from the database
$dep_names = array();
$sql = "SELECT dep_name, dep_name FROM department";
$result = $connection->query($sql);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $dep_names[$row['dep_name']] = $row['dep_name'];
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("Location: additem.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM items WHERE id = $id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location: additem.php");
        exit;
    }

    $item_name = $row["item_name"];
    $dep_name = isset($row["dep_name"]) ? $row["dep_name"] : ""; // Handle undefined key
    $property_code = $row["property_code"];
    $end_user = $row["end_user"];
    $description = $row["description"];
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST["id"];
    $item_name = $_POST["item_name"];
    $dep_name = $_POST["dep_name"];
    $property_code = $_POST["property_code"];
    $end_user = $_POST["end_user"];
    $description = $_POST["description"];

    if (empty($id) || empty($item_name) || empty($dep_name) || empty($property_code) || empty($end_user) || empty($description)) {
        $errorMessage = "All fields are required";
    } else {
        $sql = "UPDATE items " .
            "SET item_name = '$item_name', dep_name = '$dep_name', property_code = '$property_code', end_user = '$end_user', description = '$description' " .
            "WHERE id = $id";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
        } else {
            $successMessage = "Item Updated";

            header("Location: items_page.php");
            exit;
        }
    }
}
?>