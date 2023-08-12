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
                        <li class="mb-2 w-full hover:bg-red-300/20 p-3 rounded-md font-semibold flex gap-1 "><img src="./image/dashboard.png" class="rounded w-6 h-6">Dashboard   </li>
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
                        <li class="mb-2 w-full p-3 bg-red-300/20 rounded-md font-bold flex gap-1 items-center transition ease-out duration-300"><img src="./image/icons8-approval-48.png"  class="bg-white p-1 rounded w-6 h-6">Manage Approval</li>
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

    

    <article class=" col-span-4 py-6 pr-6 w-full h-full ">
        
        <div class="flex justify-between text-white">
            <div class="font-semibold text-2xl flex flex-cols"><p>Manage Approval</p> </div>
            <p class="font-semibold"> Welcome  Admin <span class="font-bold text-xl" ><?php echo ucfirst($row['firstname']) ." ".ucfirst ($row['lastname']);?></span></p>
        </div>

        

        <div class="grid grid-cols-5 mt-6 h-[95.2%] pb-6 gap-6">
            <div class="col-span-5 p-10 h-full bg-white grid content-between rounded-xl drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)] mb-5">
                <div>
                <center class="mb-10 text-2xl font-bold">For Approval </center>

                 <table class="w-full ">
                    <thead>
                        <tr>
                            <th class="pb-3">ID</th>
                            <th class="pb-3">Requisitioner</th>
                            <th class="pb-3">Item Name</th>
                            <th class="pb-3">Department</th>
                            <th class="pb-3">Purpose</th>
                            <th class="pb-3">Status</th>
                            <th class="pb-3 ">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                            $num = 0;
                            $req = mysqli_query($db,"SELECT * FROM requests WHERE r_status='pending'");
                            while($row2 = mysqli_fetch_assoc($req)) {
                                $num++;
                                ?>
                            <tr class="border-b">
                                <td class="text-center py-2"> <?php echo $num; ?></td>
                                <td class="text-center py-2"> <?php echo ucfirst($row2['requester']); ?></td>
                                <td class="text-center py-2"> <?php echo ucfirst($row2['item_name']); ?></td>
                                <td class="text-center py-2"> <?php echo ucfirst($row2['dep_name']); ?></td>
                                <td class="text-center py-2"> <?php echo ucfirst($row2['purpose']);?></td>
                                <td class="text-center py-2"> <?php echo ucfirst($row2['r_status']);?></td>
                                <td class="text-center py-2"> <a href="index_approval.php?id=<?php echo $row2['r_id']; ?>" class="border-r pr-2 mr-2" style='color:green; font-weight:700;'>
                                Approve</a>
                                <a href="index_approval.php?did=<?php echo $row2['r_id']; ?>" class=" pr-2 mr-2" style='color:red; font-weight:700;'>
                                Decline</a>
                                </td>

                            </tr>


                        <?php

                            }
                        ?>
                    </tbody>
                </table>
                </div>  

                <?php
                    if(isset($_GET['did'])){  //decline request
                    $id = $_GET['did'];
                ?>
                    <div>
                        <form method="POST" class="flex justify-end gap-4 ">

                                <div class="col-sm-2">
                                    <label>Reason to decline request:</label>
                                    <input type="text" class="border-2 border-gray-300 rounded py-1 pl-2 w-60" name="reason"  value="<?php if(isset($_POST['reason'])){ echo $_POST['reason']; } ?>">
                                </div>
                                <button type="submit" class="w-32 bg-red-500 rounded text-white font-semibold duration-300 ease-out transition hover:text-red-500 hover:bg-white py-1 border border-red-500" name="decline">Submit</button>
                        </form>
                    </div>
                <?php
                        if(isset($_POST['decline'])){
                            $reason = $_POST['reason'];
                            $tr = trim($reason);
                            $dec = "declined";
                            $emp =  strlen($tr);
                            if(!empty($reason) || $emp > 0){

                                mysqli_query($db,"UPDATE requests SET r_status='$dec', reason='$reason' WHERE r_id='$id'");

                                ?>
                                <script>
                                       swal({title: "Declined!", text: "Request has been declined", type:"success",icon:"success"})
                                           .then(function(){ 
                                              location.href="index_approval.php";
                                               });
                                </script>
                    
                                <?php
                                
                            }elseif(empty($reason) || $emp == 0 ){
                                ?>
                             <script>
                                swal({title: "Invalid!", text: "Please indicate reason to decline.", type:"warning",icon:"warning"})
                             </script>


                        <?php
                            }
                        }

                }
             ?>

            </div>
            
<?php  
        // get approve id

        if(isset($_GET['id'])){
            $id = $_GET['id'];

            $ap = "approved";

            mysqli_query($db,"UPDATE requests SET r_status='$ap' WHERE r_id='$id'");

            ?>
            <script>
                   swal({title: "Approved!", text: "Request for item approved.", type:"success",icon:"success"})
                       .then(function(){ 
                          location.href="index_approval.php";
                           });
            </script>

            <?php



        }
?>
            <!-- <div class="col-span-1  h-full bg-white rounded-xl drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)] mb-5">
                <div class="h-full">
                
                </div>
            </div> -->
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
