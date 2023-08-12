<?php include('server.php');   
$displayUser = "SELECT * FROM users";
$res_query = mysqli_query($db,$displayUser);

$total_users = mysqli_num_rows($res_query);
$act = "active";
$active_query= "SELECT * FROM users WHERE status='$act'";
$active_result = mysqli_query($db,$active_query);
$total_active = mysqli_num_rows($active_result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/department_mgmt.css">
    

    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
       #logoutModal{
            display: none;
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
        .newItemButton{
            box-shadow: 2px 2px 0px 0px #000000;
        }
        .newItemButton:hover{
            box-shadow:2px 2px 0px 0px #ff4d4d; 
        }
        .itemEditButton{
            box-shadow: 2px 2px 0px 0px #000000;
        }
        .itemEditButton:hover{
            box-shadow:2px 2px 0px 0px #66cc00;
        }
        .itemDeleteButton{
            box-shadow: 2px 2px 0px 0px #000000;
        }
        .itemDeleteButton:hover{
            box-shadow:2px 2px 0px 0px #ff4d4d;
        }
    </style>

    <title>GSO Invsys</title>
    
  
</head>

<body class=" text-black w-full h-screen grid grid-cols-5">

    <?php 
        if (isset($_SESSION['success'])): 
    ?>

    <?php
        echo $_SESSION['success'];
        unset($_SESSION['success']);
    ?>
    <?php endif ?>

    <?php 
    if (isset($_SESSION['username'])): 
        
    ?>

<!-- Navbar -->
    <nav class=" p-6 fixed h-full w-[20%]">
        <div class="drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)] h-full w-full rounded-xl bg-white p-8 text-center flex flex-col ">
            <a href="index.php" class="text-2xl font-bold"><span class="text-[red]">GSO</span> InvSystem</a>
            <hr class="mt-5 border border-black">
            <div class="text-start w-full mt-10 ">
                <ul>
                    <a aria-current="page" href="index.php">
                        <li class="mb-2 w-full hover:bg-red-300/20 p-3 rounded-md font-semibold flex gap-1 transition ease-out duration-300 "><img src="./image/dashboard.png" class="rounded w-6 h-6">Dashboard</li>
                    </a>
                    <a href="user_management.php">
                        <li class="mb-2 w-full p-3 hover:bg-red-300/20 rounded-md font-semibold flex gap-1 items-center transition ease-out duration-300"><img src="./image/users.png" class="bg-white p-1 rounded w-6 h-6">Users</li>
                    </a>

                    <a href="user_management_dept.php">
                        <li class="mb-2 w-full p-3 hover:bg-red-300/20 rounded-md font-semibold flex gap-1 items-center "><img src="./image/department.png"  class="bg-white p-1 rounded w-6 h-6">Departments</li>
                    </a>
                    

                    <a href="items_page.php">
                        <li class="mb-2 w-full p-3 bg-red-300/20 rounded-md font-bold flex gap-1 items-center transition ease-out duration-300"><img src="./image/packaging.png"  class="bg-white p-1 rounded w-6 h-6">Items</li>
                    </a>
                    
                    <a href="index_approval.php">
                        <li class="mb-2 w-full p-3 hover:bg-red-300/20 rounded-md font-semibold flex gap-1 items-center transition ease-out duration-300"><img src="./image/icons8-approval-48.png"  class="bg-white p-1 rounded w-6 h-6">Manage Approval</li>
                    </a>

                    <a href="reportPage.php">
                        <li class="mb-2 w-full p-3 hover:bg-red-300/20 rounded-md font-semibold flex gap-1 items-center transition ease-out duration-300"><img src="./image/report.png"  class="bg-white p-1 rounded w-6 h-6">Reports</li>   
                    </a>

                    <a href="update_account.php">
                        <li class="mb-2 w-full p-3 hover:bg-red-300/20 rounded-md font-semibold flex gap-1 items-center transition ease-out duration-300"><img src="./image/user.png"  class="bg-white p-1 rounded w-6 h-6">My Profile</li>
                    </a>
                    
                </ul> 
        
            </div>
            <div class="flex  h-full w-full items-end">
                <button onclick="logoutModal()" class="font-semibold hover:font-bold w-full items-center  py-2 pl-2 flex rounded-md hover:bg-red-300/20 hover:pr-2"><img src="./image/icons8-logout-64.png" alt="logut" width="20" height="20"><p class="flex items-center">Log Out</p></button>
            </div>
        </div>
    </nav>

    <div class=" absolute top-0 left-0 -z-10 h-80 w-full welcomePageBg">
    </div>

    <nav class="p-6 ">
    </nav>

    <?php           $user = $_SESSION['user_id'];
                    $sql = "SELECT * FROM users WHERE user_id = '$user'";
                    $result = mysqli_query($db, $sql);
                    $row = mysqli_fetch_assoc($result);  
    ?>

    <article class=" col-span-4 pt-6 pr-6 w-full h-full  ">
        
            <div class="flex justify-between text-white">
                <p class="font-semibold text-2xl">Items</a></p>
                <p class="font-semibold"> Welcome  Admin <span class="font-bold text-xl" ><?php echo ucfirst($row['firstname']) ." ".ucfirst ($row  ['lastname']);?></span></p>
            </div>
            <div class="w-full h-[90.3%] mt-5 ">
                <div class="w-full h-full bg-white drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)] overflow-auto mr-2 rounded-xl">
                    <div>
                        <div class="p-10">
                            <a class="bg-red-500 px-4 py-1 text-white font-semibold rounded newItemButton transition ease-out duration-300 border border-red-500 hover:text-red-500 hover:bg-white" href="items_add.php" role="button">New Item</a>
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
                        <div class="px-10 ">
                        <table class="w-full p-5">
                            <thead >
                                <tr>
                                    <th class="pb-3">ID</th>
                                    <th class="pb-3">Item Name</th>
                                    <th class="pb-3">Department</th>
                                    <th class="pb-3">Property Code</th>
                                    <th class="pb-3">Qty</th>
                                    <th class="pb-3">User</th>
                                    <th class="pb-3">Description</th>
                                    <th class="pb-3">Date Added</th>
                                    <th class="pb-3">Action</th>
                                    
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
                                ?>
                               
                                    <tr data-dep-id='<?php $row['dep_name']?>' class="border-b-2 border-gray-200">
                                        <td class="text-center py-2"><?php echo $row['id']?></td>
                                        <td class="text-center py-2"><?php echo $row['item_name']?></td>
                                        <td class="text-center py-2"><?php echo $row['dep_name']?></td>
                                        <td class="text-center py-2"><?php echo $row['property_code']?></td>
                                        <td class="text-center py-2"><?php echo $row['quantity']?></td>
                                        <td class="text-center py-2"><?php echo $row['end_user']?></td>
                                        <td class="text-center py-2"><?php echo $row['description']?></td>
                                        <td class="text-center py-2"><?php echo $row['created_at']?></td>
                                        <td class="  flex justify-center gap-2 py-2 ">
                                            <a class='bg-green-500 text-center w-20 itemEditButton rounded transition ease-out text-white font-semibold duration-300 hover:bg-white hover:text-green-500 border border-green-500 ' href='items_Edit.php?id=<?php echo $row['id']?>'>Edit</a>
                                            <a class='bg-red-500 w-20 text-center itemDeleteButton rounded transition ease-out text-white font-semibold duration-300 hover:bg-white hover:text-red-500 border border-red-500 ' href='deleteitem.php?id=<?php echo $row['id']?>'>Delete</a>
                                        </td>
                                    </tr>
                          
                                <?php
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
                        </div>
                    </div>
                </div>
            </div>
    </article>
    
    <div class="fixed top-0 left-0 h-full w-full bg-white/30 backdrop-blur-sm" id="logoutModal" >
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

<script src="./script/jscript.js" ></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    // Add event listener to the dropdown
    $('#deptSelect').change(function () {
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
<?php endif ?>
</body>
</html>