<?php include('server.php');   

 // Assuming $db is your database connection
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

 // Fetch item data from the "items" table and count the total number of items
 $sql = "SELECT COUNT(*) AS total_items FROM items";
 $result = $connection->query($sql);

 // Initialize $items variable
 $items = 0;

 // Store the count of items in the $items variable
 if ($result && $result->num_rows > 0) {
     $row = $result->fetch_assoc();
     $items = (int)$row['total_items'];
 }

 // Close the database connection
 $connection->close();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="../GSOInvSys/css/style.css">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>GSO Invsys</title>
    <style>
        .welcomePageBg{
            background-image: url('./image/welcomeBg.jpg');
        }
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

        .approve{
            padding: .5rem;
            background: tomato;
            color: black;
            margin-top: .2rem;
            margin-bottom: .5rem;
            border-radius: 5px;
            margin-left: 1rem;
        }

        .approve:hover{
            color:white;
        }
    </style>
  
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
        
        $user = $_SESSION['user_id'];
        $userID = $_SESSION['user_id'];
        $sql = "SELECT * FROM users WHERE user_id = '$user'";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);  

                $rq = mysqli_query($db,"SELECT * FROM requests WHERE r_status='pending'");
                $count_row = mysqli_num_rows($rq);

            ?>
<!-- Navbar -->
    <nav class=" p-6 fixed h-full w-[20%]">
        <div class="drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)] h-full w-full rounded-xl bg-white p-8 text-center flex flex-col ">
            <a href="index.php" class="text-2xl font-bold"><span class="text-[red]">GSO</span> InvSystem</a>
            <hr class="mt-5 border border-black">
            <div class="text-start w-full mt-10 ">
                <ul>
                    <a aria-current="page" href="index.php">
                        <li class="mb-2 w-full bg-red-300/20 p-3 rounded-md font-bold flex gap-1 "><img src="./image/dashboard.png" class="rounded w-6 h-6">Dashboard   </li>
                    </a>
                    <a href="user_management.php">
                        <li class="mb-2 w-full p-3 hover:bg-red-300/20 rounded-md font-semibold flex gap-1 items-center transition ease-out duration-300"><img src="./image/users.png" class="bg-white p-1 rounded w-6 h-6">Users</li>
                    </a>

                    <a href="user_management_dept.php">
                        <li class="mb-2 w-full p-3 hover:bg-red-300/20 rounded-md font-semibold flex gap-1 items-center transition ease-out duration-300"><img src="./image/department.png"  class="bg-white p-1 rounded w-6 h-6">Departments</li>
                    </a>
                    

                    <a href="items_page.php">
                        <li class="mb-2 w-full p-3 hover:bg-red-300/20 rounded-md font-semibold flex gap-1 items-center transition ease-out duration-300"><img src="./image/packaging.png"  class="bg-white p-1 rounded w-6 h-6">Items</li>
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
                <button onclick="logoutModal()" class="font-semibold hover:font-bold w-full justify-start items-center  py-2 pl-2 flex rounded-md hover:bg-red-300/20 hover:pr-2 transition ease-out duration-300"><img src="./image/icons8-logout-64.png" alt="logut" width="20" height="20"><p class="flex items-center">Log Out</p></button>
            </div>
        </div>
    </nav>

    <div class=" absolute top-0 left-0 -z-10 h-80 w-full welcomePageBg">
    </div>

    <nav class="p-6 ">
    </nav>

    

    <article class=" col-span-4 py-6 pr-6 w-full h-screen ">
        
        <div class="flex justify-between text-white">
            <div class="font-semibold text-2xl flex flex-cols"><p>DashBoard</p> </div>
            <p class="font-semibold"> Welcome  Admin <span class="font-bold text-xl" ><?php echo ucfirst($row['firstname']) ." ".ucfirst ($row['lastname']);?></span></p>
        </div>

        <div class="w-full h-1/6 grid grid-cols-4 mt-10 gap-6 drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)] ">
            <div class="bg-white rounded-xl p-5 drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)]">
                <div class="grid grid-cols-3">
                    <div class="col-span-2">
                        <p class="text-lg flex font-bold">Total Active User</p>
                        <p class=" font-semibold"><?php echo $total_users; ?></p>
                    </div>
                    <div class="flex justify-end">
                        <i><img src="./image/icons8-account-24.png" class="h-10 w-10 rounded-full border p-2 bg-red-200"></img></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-5 drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)]">
                <div class="grid grid-cols-3">
                    <div class="col-span-2">
                        <p class="text-xl flex font-bold">Total Users Online</p>
                        <p class="text-lg font-semibold"><?php echo $total_online; ?></p>
                    </div>
                    <div class="flex justify-end">
                        <i><img src="./image/icons8-account-24.png" class="h-10 w-10 rounded-full border p-2 bg-red-200"></img></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-5 drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)]">
                <div class="grid grid-cols-3">
                    <div class="col-span-2">
                        <p class="text-xl flex font-bold">Total Items</p>
                        <p class="text-lg font-semibold"><?php echo $items; ?></p>
                    </div>
                    <div class="flex justify-end">
                        <i><img src="./image/item.png" class="h-10 w-10 rounded-full border p-2 bg-red-200"></img></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)]">
            <div class="grid grid-cols-3 p-5">
                    <div class="col-span-2">
                        <p class="text-xl flex font-bold">For Approval</p>
                        <p class="text-lg font-semibold"><?php echo $count_row; ?></p>
                        
                    </div>
                    <div class="flex justify-end">
                        <i><img src="./image/icons8-approval-482.png" class="h-10 w-10 rounded-full border p-2 bg-red-200"></img></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-6 mt-6 h-[73%]  pb-6 gap-6">
            <div class="col-span-3 p-10 h-full bg-white rounded-xl drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)] mb-5">
                <table class="w-full">
                    <thead> 
                        <tr >
                            <th class="pb-3">ID</th>
                            <th class="pb-3">Fullname</th>
                            <th class="pb-3">Username</th>
                            <th class="pb-3">Department</th>
                            <th class="pb-3">Login Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $num = 0;
                            while($row = mysqli_fetch_assoc($res_query)) {
                                $num++;
                        ?>
                            <tr class="border-b">
                                <td class="text-center py-2"> <?php echo $num; ?></td>
                                <td class="text-center py-2"> <?php echo ucfirst($row['firstname'])." ". ucfirst($row['lastname']); ?></td>
                              
                                <td class="text-center py-2"> <?php echo ucfirst($row['username']); ?></td>
                                <td class="text-center py-2"> <?php echo ucfirst($row['department']);?></td>
                                <td class="text-center py-2">  <?php 
                                
                                    if($row['mode'] ==="online" ){
                                        ?>
                                            <p style='color: green; font-weight: 700;'> <?php echo ucfirst($row['mode']);  ?>  </p>

                                    <?php
                                    }else if($row['mode'] ==="offline" ){
                                        ?>
                                             <p style='color: black; font-weight: 700;'> <?php echo ucfirst($row['mode']);  ?>  </p>
                                        <?php
                                    }
                                
                                
                                ?> </td>
                            </tr>
                        <?php  }  ?>
                    </tbody>    
                </table>

            </div>
            
                <div class=" col-span-3 h-full bg-white rounded-xl drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)] mb-5 overflow-x-auto">
                    <div class="h-full p-10 ">
                        <table class="w-full">
                            <thead>
                                <tr>
                                    <th class="pb-3">ID</th>
                                    <th class="pb-3">Item Name</th>
                                    <th class="pb-3">Department</th>
                                    <th class="pb-3">Property Code</th>
                                    <th class="pb-3">User</th>

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

                                // Read data of each row and display in the table
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr data-dep-id='<?php echo $row['dep_name']?>'>
                                        <td class="text-center border-b-2 border-gray-200 py-2"><?php echo $row['id']?></td>
                                        <td class="text-center border-b-2 border-gray-200 py-2"><?php echo $row['item_name']?></td>
                                        <td class="text-center border-b-2 border-gray-200 py-2"><?php echo $row['dep_name']?></td>
                                        <td class="text-center border-b-2 border-gray-200 py-2"><?php echo $row['property_code']?></td>
                                        <td class="text-center border-b-2 border-gray-200 py-2"><?php echo $row['end_user']?></td>
                                    </tr>
                                <?php
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

<script src="./script/jscript.js"> 

 </script>
<?php endif ?>
</body>
</html>
