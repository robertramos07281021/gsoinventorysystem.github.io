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
        header("Location: /gsoinvsystem/additem.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM items WHERE id = $id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location: /gsoinvsystem/additem.php");
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

            header("Location: /gsoinvsystem/Item.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Edit Item</h2>
        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>

        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Item Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="item_name" value="<?php echo $item_name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">department</label>
                <div class="col-sm-6">
                    <select class="form-select" name="dep_name">
                        <?php foreach ($dep_names as $depId => $dep_name) {
                            $selected = ($depId == $dep_name) ? 'selected' : '';
                            echo "<option value='$depId' $selected>$dep_name</option>";
                        } ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Property Code</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="property_code" value="<?php echo $property_code; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">User</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="end_user" value="<?php echo $end_user; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="description" value="<?php echo $description; ?>">
                </div>
            </div>
            <?php
            if (!empty($successMessage)) {
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>$successMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3
                col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/gsoinvsystem/Item.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>

