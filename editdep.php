<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "gsoinventory";

// Connection to the database
$connection = new mysqli($servername, $username, $password, $database);

// Function to validate required fields
function validate_fields($required_fields) {
    global $errors;

    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[] = ucfirst($field) . " is required.";
        }
    }
}

// Function to remove unwanted characters and sanitize data
function remove_junk($value) {
    // Implement your logic to sanitize the data here, for example:
    $value = trim($value);              // Remove leading and trailing spaces
    $value = stripslashes($value);      // Remove backslashes
    $value = htmlspecialchars($value); // Convert special characters to HTML entities
    return $value;
}

// Function to find data by ID from the database
function find_by_id($table, $id) {
    global $connection;

    $sql = "SELECT * FROM " . $table . " WHERE dep_id = " . (int)$id;
    $result = $connection->query($sql);

    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

// Function to display session messages
function display_msg() {
    if (!empty($_SESSION['message'])) {
        $msg = $_SESSION['message'];
        unset($_SESSION['message']);
        return $msg;
    }
    return '';
}

// Function to redirect
function redirect($url, $permanent = false) {
    if (!headers_sent()) {
        header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}

// Get department data by ID
$department = find_by_id('department', (int)$_GET['id']);
if (!$department) {
    $_SESSION['message'] = "Missing department ID.";
    redirect('department.php');
}

// Handle form submission
if (isset($_POST['edit_department'])) {
    $req_field = array('dep_name');
    validate_fields($req_field);
    $dep_name = remove_junk($connection->escape_string($_POST['dep_name']));
    if (empty($errors)) {
        $sql = "UPDATE department SET dep_name = '{$dep_name}' WHERE dep_id = '{$department['dep_id']}'";
        if ($connection->query($sql)) {
            $_SESSION['message'] = "Successfully Updated department";
            redirect('department.php', false);
        } else {
            $_SESSION['message'] = "Sorry, failed to update.";
            redirect('department.php', false);
        }
    } else {
        $_SESSION['message'] = $errors;
        redirect('department.php', false);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit department</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
</head>
<body>
    <div class="row">
        <div class="col-md-12">
            <?php echo display_msg(); ?>
        </div>
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>
                        <span class="glyphicon glyphicon-th"></span>
                        <span>Editing <?php echo remove_junk(ucfirst($department['dep_name'])); ?></span>
                    </strong>
                </div>
                <div class="panel-body">
                    <form method="post" action="editdep.php?id=<?php echo (int)$department['dep_id']; ?>">
                        <div class="form-group">
                            <input type="text" class="form-control" name="dep_name"
                                value="<?php echo remove_junk(ucfirst($department['dep_name'])); ?>">
                        </div>
                        <button type="submit" name="edit_department" class="btn btn-primary">Update department</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
