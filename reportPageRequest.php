<?php include('server.php'); ?>

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

$departments = array(); // Initialize an array to hold department names

// Fetch the list of departments from the database
$sql = "SELECT dep_name FROM department"; // Modify the query to match your table structure
$result = $connection->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $departments[] = $row['dep_name'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>GSO Invsys</title>

   <style>
        .welcomePageBg{
            background-image: url("./image/welcomeBg.jpg");
        }
        #printButton{
            box-shadow:2px 2px 0px 0px #000000; 
        }
        #printButton:hover{
            box-shadow:2px 2px 0px 0px #ff4d4d; 
        }
        #logOutButtonYes{
            box-shadow: 2px 2px 0px 0px #000000;
        }
        #logOutButtonNo{
            box-shadow: 2px 2px 0px 0px #000000;
        }
        #logOutButtonYes:hover{
            box-shadow:2px 2px 0px 0px #66cc00;
        }
        #logOutButtonNo:hover{
            box-shadow:2px 2px 0px 0px #ff4d4d; 
        }
   </style>
    
</head>
<body class=" text-black w-full h-screen grid grid-cols-5 ">
   


<nav class=" p-6 fixed h-full w-[20%]">
        <div class="drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)] h-full w-full rounded-xl bg-white p-8 text-center flex flex-col">
            <a href="index.php" class="text-2xl font-bold"><span class="text-[red]">GSO</span> InvSystem</a>
            <hr class="mt-5 border border-black">
            <div class="text-start w-full mt-10">
            <ul>
                    <a aria-current="page" href="index_user.php">
                        <li class="mb-2 w-full bg-red-300/20 p-3 rounded-md font-bold flex gap-1 "><img src="./image/dashboard.png" class="rounded w-6 h-6">Dashboard</li>
                    </a>
                    <a href="myrequest.php">
                        <li class="mb-2 w-full p-3 hover:bg-red-300/20 rounded-md font-semibold flex gap-1 items-center transition ease-out duration-300"><img src="./image/users.png" class="bg-white p-1 rounded w-6 h-6">My Requests</li>
                    </a>

               
                    <a href="reportPageRequest.php">
                        <li class="mb-2 w-full p-3 hover:bg-red-300/20 rounded-md font-semibold flex gap-1 items-center transition ease-out duration-300"><img src="./image/report.png"  class="bg-white p-1 rounded w-6 h-6">Reports</li>   
                    </a>

                    <a href="update_account_user.php">
                        <li class="mb-2 w-full p-3 hover:bg-red-300/20 rounded-md font-semibold flex gap-1 items-center transition ease-out duration-300"><img src="./image/user.png"  class="bg-white p-1 rounded w-6 h-6">My Profile</li>
                    </a>
                    
                </ul>   
            </div>
            <div class="flex  h-full w-full items-end">
                <button onclick="logoutModal()" class="font-semibold hover:font-bold w-full requests-center  py-2 pl-2 flex rounded-md hover:bg-red-300/20 hover:pr-2"><img src="./image/icons8-logout-64.png" alt="logut" width="20" height="20"><p class="flex requests-center">Log Out</p></button>
            </div>
        </div>
    </nav>

    <div class=" absolute top-0 left-0 -z-10 h-80 w-full welcomePageBg">
    </div>
  
    <article class=" col-start-2 col-span-4 mr-6" id="reportPrintDiv">
    <?php
        //connect to db and display account details
        $user = $_SESSION['user_id'];
        $sql = "SELECT * FROM users WHERE user_id = '$user'";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
    ?>

        <div class="flex justify-between text-white">
            <p class="font-semibold text-3xl mt-5">My Profile</a></p>
            <p class="font-semibold mt-5"> Welcome  Admin <span class="font-bold text-xl" ><?php echo ucfirst($row['firstname']) ." ".ucfirst ($row['lastname']);?></span></p>
        </div>
        <div class="bg-white pt-5 rounded-xl h-[87%] drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)] p-10 mt-5">
            <center class="mb-5 text-2xl font-semibold">
            <h2>GSO Invsys Inventory Report</h2>
            <h3>As of <?= date('m-d-Y'); ?></h3>
            </center>
          
    
            <!-- Add the dropdown for selecting the department -->
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <label for="departmentSelect" class="font-semibold text-lg ">Select Department:</label>
                        <select id="departmentSelect" class="border-2 border-gray-100 p-1 w-60 rounded-lg" onchange="redirectToReport(this)">
                            <option value="">Select Department</option>
                            <?php foreach ($departments as $dept): ?>
                                <option value="<?= $dept; ?>"><?= $dept; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
                            
            <br />
            <div class="flex flex-col grid content-between h-[79%] ">
                <div>
                    <table id="myTable-report" class="" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="pb-5">request Name</th>
                                <th class="pb-5">Department</th>
                                <th class="pb-5">Property Code</th>
                                <th class="pb-5">Quantity</th>
                                <th class="pb-5">End User</th>
                                <th class="pb-5">Created At</th>
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
                        
                            // Read all rows from the database table "requests" and join with "department" table to get department name
                            $sql = "SELECT requests.*, department.dep_name 
                                    FROM requests 
                                    LEFT JOIN department ON requests.dep_name = department.dep_name";

                            $result = $connection->query($sql);
                        
                            if (!$result) {
                                die("Invalid query: " . $connection->error);
                            }
                        
                            // Initialize an array to store the request counts per department
                            $requestCounts = array();
                        
                            // Read data of each row and display in the table
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr data-dep-id='<?php echo $row['dep_name']?>'>
                                    <td class="text-center border-b-2 border-gray-100 pb-2"><?php echo  $row['requester']?></td>
                                    <td class="text-center border-b-2 border-gray-100 pb-2"><?php echo $row['dep_name']?></td>
                                    <td class="text-center border-b-2 border-gray-100 pb-2"><?php echo $row['property_code']?></td>
                                    <td class="text-center border-b-2 border-gray-100 pb-2"><?php echo $row['r_status']?></td>
                                    <td class="text-center border-b-2 border-gray-100 pb-2"><?php echo $row['end_user']?></td>
                                    <td class="text-center border-b-2 border-gray-100 pb-2"><?php echo $row['date']?></td>
                                </tr>
                            <?php   

                                // Count the requests per department and store it in the array
                                $department = isset($row['dep_name']) ? ucfirst($row['dep_name']) : '';
                                if (isset($requestCounts[$department])) {
                                    $requestCounts[$department]++;
                                } else {
                                    $requestCounts[$department] = 1;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                    
                <div class="w-full  flex justify-end">
                    <!-- Include the redirect function directly in the onclick attribute -->
                    <button id="printButton" class="w-36 py-1 bg-red-500 text-white text-lg font-semibold rounded transition ease-out duration-300 border border-red-500 hover:text-red-500 hover:bg-white"
                    onclick="redirectToReportInNewTab()">Print Report</button>
                </div>
            </div>
        </div>
    </article>
    <div class="absolute top-0 left-0 h-full w-full bg-white/30 backdrop-blur-sm hidden" id="logoutModal" >
        <div class="flex w-full h-full justify-center items-center">
            <div class="h-56 w-80 fixed rounded drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)]" >
                <div class="bg-white h-full w-full flex flex-col rounded-md">
                    <p class="text-black font-bold pl-2 py-2 self-start border w-full flex "><img src="./image/icons8-logout-64.png" alt="logut" width="20" height="20">Log Out</p>
                    <div class="text-center flex flex-col justify-center border w-full h-full">
                        <p class="font-semibold">Do you want to logout?</p>
                        <div class="flex justify-center gap-10 mt-10">
                            <a href="index.php?logout='1'" class=" font-bold"><button class="p-1  w-20 bg-green-500 rounded text-white border border-green-500 font-semibold transition ease-out duration-300 hover:bg-white hover:text-green-500 hover:border-green-500" id="logOutButtonYes">Yes</button></a>
                            
                            <button class="p-1 w-20 bg-red-500 rounded text-white border border-red-500 font-semibold transition ease-out duration-300 hover:bg-white hover:text-red-500 hover:border-red-500" onclick="noLogout()" id="logOutButtonNo">No</button>
                        </div>    
                    </div>
                </div>
            <div>
        </div>
    </div>


    <script src="./script/jscript.js">
    </script>
    <script> 
        function redirectToReportInNewTab() {
            var selectedDepartment = document.getElementById('departmentSelect').value;
            var url = 'reportfunction.php?department=' + encodeURIComponent(selectedDepartment);
            var newTab = window.open(url, '_blank');
            newTab.focus();
        }
      
        function filterTableByDepartment(selectedDepartment) {
        var rows = document.querySelectorAll("#myTable-report tbody tr");

        for (var i = 0; i < rows.length; i++) {
            var row = rows[i];
            var department = row.getAttribute("data-dep-id");

            // If no department is selected or the row's department matches the selected department, show the row
            if (!selectedDepartment || department === selectedDepartment) {
            row.style.display = "table-row";
            } else {
            row.style.display = "none";
            }
        }
        }
        

        document
        .getElementById("departmentSelect")
        .addEventListener("change", function () {
            var selectedDepartment = this.value;
            filterTableByDepartment(selectedDepartment); // Call the function with the selected department
        });

        
    </script>
</body>
</html>
