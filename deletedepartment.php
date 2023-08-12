<?php
if (isset($_GET["id"])) {
    $id = $_GET['id'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "gsoinventory";

    // Connect to the database
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM department WHERE dep_id = ?"; // Changed "id" to "department_id"
    $statement = $connection->prepare($sql);
    $statement->bind_param("i", $id);
    $statement->execute();
    $statement->close();
}

header("Location: /GSOInvSys/department.php");
exit;
?>
