<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "gsoinventory";

// Connection to the database
$connection = new mysqli($servername, $username, $password, $database);

$item_name = $dep_names = $property_code = $end_user = $description = "";

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
    $end_user = $_POST["end_user"];
    $description = $_POST["description"];

    if (empty($item_name) || empty($dep_name) || empty($property_code) || empty($end_user) || empty($description)) {
        $errorMessage = "All fields are required";
    } else {
        // Add new item to the database
       // Add new item to the database with the current timestamp for created_at
        $sql = "INSERT INTO items (item_name, dep_name, property_code, end_user, description, created_at) " .
        "VALUES ('$item_name','$dep_name','$property_code','$end_user','$description', NOW())";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
        } else {
            $successMessage = "Item added correctly";
            // Redirect to a success page
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
    <title>Create Item</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" ></script>
</head>
<body>
<!-- <nav class=" p-6 fixed h-full w-[20%]">
        <div class="drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)] h-full w-full rounded-xl bg-white p-8 text-center">
            <a href="index.php" class="text-2xl font-bold"><span class="text-[red]">GSO</span> InvSystem</a>
            <hr class="mt-5 border border-black">
            <div class="text-start w-full mt-10">
            <ul>
                    <a aria-current="page" href="index.php">
                        <li class="mb-5 w-full hover:bg-red-300/20 p-3 rounded-md">Dashboard</li>
                    </a>
                    <a href="user_management.php">
                        <li class="mb-5 w-full p-3 rounded-md bg-red-300/20 p-3 font-bold">User Management</li>
                    </a>
                    
                    <a href="department.php">
                        <li class="mb-5 w-full p-3 hover:bg-red-300/20 rounded-md">department</li>
                    </a>

                    <a href="#">
                        <li class="mb-5 w-full p-3 hover:bg-red-300/20 rounded-md">Reports</li>   
                    </a>

                    <a href="update_account.php">
                        <li class="mb-5 w-full p-3 hover:bg-red-300/20 rounded-md">My Profile</li>
                    </a>
                </ul>  
        
            </div>
        </div>
    </nav> -->
    <div class="container my-5">
        <h2>New Item</h2>
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
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Item Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="item_name" value="<?php echo $item_name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">department</label>
                <div class="col-sm-6">
                    <select class="form-select" name="dep_names">
                        <?php foreach ($dep_names as $dep_name => $dep_names) { // Loop through dep_names array
                            echo "<option value='" . htmlspecialchars($dep_name) . "'>" . htmlspecialchars($dep_names) . "</option>";
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
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="item.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
