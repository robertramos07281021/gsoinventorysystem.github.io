<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>GSO Invsys Report</title>
    <!-- Bootstrap Core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap-theme.min.css">
    <link href="../assets/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <script src="./script/report.js"></script>
</head>
<body>
    <center>
        <h2>GSO Invsys Inventory Report</h2>
        <h3>As of <?= date('m-d-Y'); ?></h3>
    </center>
    <br />
    <div class="table-responsive">
        <table class="table table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Department</th>
                    <th>Property Code</th>
                    <th>Quantity</th>
                    <th>End User</th>
                    <th>Created At</th>
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
                
                // Retrieve the selected department from the URL parameter
                $selectedDepartment = isset($_GET['department']) ? $_GET['department'] : '';
                

                // Query to retrieve data based on the selected department
                $sql = "SELECT items.*, department.dep_name FROM items 
                        LEFT JOIN department ON items.dep_name = department.dep_name
                        WHERE department.dep_name = '$selectedDepartment'";
                
                $result = $connection->query($sql);
                
                if ($result && $result->num_rows > 0) {
                    echo "Number of Rows: " . $result->num_rows . "<br>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['item_name']}</td>";
                        echo "<td>{$row['dep_name']}</td>";
                        echo "<td>{$row['property_code']}</td>";
                        echo "<td>{$row['quantity']}</td>";
                        echo "<td>{$row['end_user']}</td>";
                        echo "<td>{$row['created_at']}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No data available for the selected department.</td></tr>";
                }
                $connection->close();
                ?>
            </tbody>
        </table>
    </div>
     <script>
        
        // Wait for the page to fully load
        window.addEventListener('load', function () {
            // Trigger the print dialog after a short delay
            setTimeout(function () {
                window.print();
            }, 1000); // Delay of 1 second (adjust as needed)
        });
        function filterTableByDepartment(selectedDepartment) {
            var rows = document.querySelectorAll("tbody tr");

            for (var i = 0; i < rows.length; i++) {
                var row = rows[i];
                var department = row.querySelector("td:nth-child(2)").textContent; // Assuming department column is the second column

                // If no department is selected or the row's department matches the selected department, show the row
                if (!selectedDepartment || department === selectedDepartment) {
                    row.style.display = "table-row";
                } else {
                    row.style.display = "none";
                }
            }
        }
    // Call the function initially with the selected department (if available)
        var initialSelectedDepartment = '<?php echo isset($_GET["department"]) ? $_GET["department"] : ""; ?>';
        filterTableByDepartment(initialSelectedDepartment);
        
    </script>
</body>
</html>

