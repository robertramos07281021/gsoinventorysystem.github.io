

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Items</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
</head>
<body>
<div class="grid grid-cols-5 mt-6 h-[87%] pb-6 gap-6">
    <div class="col-span-5  h-full bg-white rounded-xl drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)] mb-5 px-10 pt-10 ">
        <div class="overflow-auto h-full">
            <article class=" col-span-4 py-6 pr-6 w-full h-full ">
            <div class="container my-5">
                    <a href="index.php"><button>Back</button></a>
                    <h2>List of Items</h2>
                    <a class="btn btn-primary" href="additem.php" role="button">New Item</a>
                    <br><br>
                    <!-- Add the dropdown to filter items by department -->
                    <select class="w-full p-1 border-t border-black font-semibold outline-0" id="deptSelect">
                        <option value="">Select Department</option>
                        <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $database = "gsoinventory";

                        // Connection to the database
                        $connection = new mysqli($servername, $username, $password, $database);

                        // Check connection
                        if ($connection->connect_error) {
                            die("Connection failed: " . $connection->connect_error);
                        }

                        // Fetch the list of departments from the "department" table
                        $deptChoice = array();
                        $sql = "SELECT dep_name FROM department";
                        $result = $connection->query($sql);
                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $deptChoice[] = $row['dep_name'];
                            }
                        }
                        $connection->close();

                        // Loop through departments and create dropdown options
                        if (count($deptChoice) > 0) {
                            foreach ($deptChoice as $deptChoices) {
                                echo "<option value='$deptChoices'>$deptChoices</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Item Name</th>
                            <th>Department Name</th>
                            <th>Property Code</th>
                            <th>User</th>
                            <th>Description</th>
                            <th>Date Added</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $database = "gsoinventory";

                        // Connection to the database
                        $connection = new mysqli($servername, $username, $password, $database);

                        // Check connection
                        if ($connection->connect_error) {
                            die("Connection failed: " . $connection->connect_error);
                        }

                        // Read all rows from the database table "items" and join with "department" table to get department name
                        $sql = "SELECT items.*, department.dep_name FROM items 
                                LEFT JOIN department ON items.dep_name = department.dep_name";
                        $result = $connection->query($sql);

                        if (!$result) {
                            die("Invalid query: " . $connection->error);
                        }

                        // Initialize an array to store the item counts per department
                        $itemCounts = array();

                        // Read data of each row and display in the table
                        while ($row = $result->fetch_assoc()) {
                            echo "
                            <tr data-dep-id='{$row['dep_name']}'>
                                <td>{$row['id']}</td>
                                <td>{$row['item_name']}</td>
                                <td>{$row['dep_name']}</td>
                                <td>{$row['property_code']}</td>
                                <td>{$row['end_user']}</td>
                                <td>{$row['description']}</td>
                                <td>{$row['created_at']}</td>
                                <td>
                                    <a class='btn btn-primary btn-sm' href='/gsoinvsystem/editItem.php?id={$row['id']}'>Edit</a>
                                    <a class='btn btn-danger btn-sm' href='/gsoinvsystem/deleteitem.php?id={$row['id']}'>Delete</a>
                                </td>
                            </tr>
                            ";

                            // Count the items per department and store it in the array
                            $department = isset($row['dep_name']) ? ucfirst($row['dep_name']) : '';
                            if (isset($itemCounts[$department])) {
                                $itemCounts[$department]++;
                            } else {
                                $itemCounts[$department] = 1;
                            }
                        }
                        
                        ?>
                    </tbody>
                </table>
            </article>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Add event listener to the dropdown
        $('#deptSelect').change(function () {
            // Get the selected department value
            var selectedDepartment = $(this).val();

            // Show/hide rows based on the selected department
            if (selectedDepartment) {
                $('tbody tr').hide();
                $('tbody tr[data-dep-id="' + selectedDepartment + '"]').show();
            } else {
                $('tbody tr').show();
            }
        });
    });
</script>
</body>
</html>