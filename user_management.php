<?php include('server.php'); 
$errors = array();
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

        #creatAccountButton{
            box-shadow: 2px 2px 0px 0px #000000;
        }

        #creatAccountButton:hover{
            box-shadow: 2px 2px 0px 0px white;
        }
        .activateButton{
            box-shadow: 2px 2px 0px 0px #000000;
        }
        .deactivateButton{
            box-shadow: 2px 2px 0px 0px #000000;
        }
        .viewButton{
            box-shadow: 2px 2px 0px 0px #000000;
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
        $userID = $_SESSION['user_id'];
    ?>

<!-- Navbar -->
    <nav class=" p-6 fixed h-full w-[20%]">
        <div class="drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)] h-full w-full rounded-xl bg-white p-8 text-center flex flex-col">
            <a href="index.php" class="text-2xl font-bold"><span class="text-[red]">GSO</span> InvSystem</a>
            <hr class="mt-5 border border-black">
            <div class="text-start w-full mt-10">
                <ul>
                    <a aria-current="page" href="index.php">
                        <li class="mb-2 w-full hover:bg-red-300/20 p-3 rounded-md font-semibold flex gap-1 transition ease-out duration-300"><img src="./image/dashboard.png" class="rounded w-6 h-6">Dashboard</li>
                    </a>
                    <a href="user_management.php">
                        <li class="mb-2 w-full p-3 bg-red-300/20 rounded-md font-bold flex gap-1 items-center "><img src="./image/users.png" class="bg-white p-1 rounded w-6 h-6">Users</li>
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
                        <li class="mb-2 w-full p-3 hover:bg-red-300/20 rounded-md font-semibold flex gap-1 items-center"><img src="./image/user.png"  class="bg-white p-1 rounded w-6 h-6">My Profile</li>
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

    <nav>
    
    </nav>

    <article class=" col-span-4 py-6 pr-6 w-full h-full  ">
        
        <div class="flex justify-between text-white ">
            <p class="font-semibold text-2xl ">Users</p>
            <p class="font-semibold"> Welcome  Admin <span class="font-bold text-xl" ><?php echo ucfirst($_SESSION['firstname']) ." ".ucfirst ($_SESSION['lastname']);?></span></p>
        </div>
        <div class="col-start-1 flex items-end mt-6">
                <a href="create_account.php"><button class="p-2 bg-white rounded-md hover:bg-gray-700 hover:text-white font-semibold transition ease-out duration-300" id="creatAccountButton">Create Account</button></a>
            </div>
        

        <div class="grid grid-cols-5 mt-6 h-[86.5%] pb-6 gap-6">
            <div class="col-span-5  h-full bg-white rounded-xl drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)] mb-5 px-10 pt-10 ">
                <div class="overflow-auto h-full">
                    <table class="w-full">
                        <thead>
                            <tr>
                                
                                <th class="w-10 pb-3">ID</th>
                                <th class="w-40 pb-3">Full Name</th>
                                <th class="w-40 pb-3">Username</th>
                                <th class="w-40 pb-3">Department</th>
                                <th class="w-40 pb-3">Role</th>
                                <th class="w-40 pb-3">Status</th>
                                <th class="w-40 pb-3">Action</th>
                                
                             </tr>
                        </thead>

                        <tbody>
                        <?php   
                            $num = 0;
                            while($row = mysqli_fetch_assoc($res_query)) {
                            $num++;

                            ////////////////////
                            if($row['user_id'] != $userID){
                        ?>
                            <tr class="border-b">
                                <!-- rowsss from database will be displayed -->
                                
                                <td class="py-3 text-center"> <?php echo  $row['user_id']; ?> </td>
                                <td class="py-3 text-center"> <?php echo  ucfirst($row['firstname']); echo " "; echo ucfirst($row['lastname']) ;?></td>
                                <td class="py-3 text-center"> <?php echo  $row['username'] ?>  </td>
                                <td class="py-3 text-center"> <?php echo  $row['department'] ?>  </td>
                                <td class="py-3 text-center"> <?php echo  $row['role'] ?>  </td>
                                <td class="py-3 text-center"> <?php echo  $row['status'] ?>  </td>
                                <td class="py-3 text-center flex justify-center"><a href="user_edit.php?id=<?php echo $row['user_id']; ?>"><div  class="border-r pr-2 mr-2 " ><p class="py-[2px] text-white bg-blue-500 border border-blue-500 w-24 rounded hover:bg-white hover:text-blue-500 transition ease-out viewButton duration-300">View </p></div> </a>
                                
                                 
                                <?php if($row['status'] === "inactive"){ ?>
                                    <a href="user_management.php?id=<?php echo $row['user_id']; ?>" class="w-24 py-[2px] bg-green-600 border border-green-600 rounded text-white transition ease-out duration-300 activateButton hover:bg-white hover:text-green-600 ">Activate</a>
                                
                                <?php } elseif($row['status'] === "active"){
                                    ?>
                                    <a href="user_management.php?id=<?php echo $row['user_id']; ?>" class="w-24 py-[2px] bg-red-400 border border-red-400 rounded text-white deactivateButton transition ease-out duration-300 hover:bg-white hover:text-red-400">Deactivate</a>
                                    <?php
                                } ?>
                                
                                </td>
                            </tr>




                        <?php 
                    
                    ////////////////
                            }// if user id does not match
                            elseif($row['user_id']==$userID){
                                ?>
                        <tr class="border-b">
                                <!-- rowsss from database will be displayed -->
                                
                                <td class="py-3 text-center"> <?php echo  $row['user_id']; ?> </td>
                                <td class="py-3 text-center"> <?php echo  ucfirst($row['firstname']); echo " "; echo ucfirst($row['lastname']) ;?></td>
                                <td class="py-3 text-center"> <?php echo  $row['username'] ?>  </td>
                                <td class="py-3 text-center"> <?php echo  $row['department'] ?>  </td>
                                <td class="py-3 text-center"> <?php echo  $row['role'] ?>  </td>
                                <td class="py-3 text-center"> <?php echo  $row['status'] ?>  </td>
                                <td class="py-3 text-center flex justify-center"><a href="update_account.php" ><p class="w-52 border py-1 text-white bg-green-500 border-green-500 rounded transition ease-out duration-300 hover:bg-white hover:text-green-500 activateButton" >View Me</p></a>
                                
                                 
                                
                                
                                </td>
                            </tr>



                            <?php
                            }
                    
                    
                    
                    } //end of while ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </article>

                        <?php
                            if(isset($_GET['id'])){
                                $id = $_GET['id'];

                                $select = mysqli_query($db, "SELECT * FROM users WHERE user_id='$id'");
                                $rows = mysqli_fetch_assoc($select);


                                if($rows['status']=== "inactive"){
                                   mysqli_query($db, "UPDATE users SET status='active' WHERE user_id='$id'");

                                   ?>
                                         <script>
                                                swal({title: "Activated!", text: "User has been activated.", type:"success"})
                                                .then(function(){ 
                                                    location.href="user_management.php";
                                                });
                                        </script>
                                   <?php
                                    

                                }elseif($rows['status']=== "active"){
                                    mysqli_query($db, "UPDATE users SET status='inactive' WHERE user_id='$id'");
                                    ?>
                                    <script>
                                           swal({title: "Deactivated!", text: "User has been deactivated.", type:"success"})
                                           .then(function(){ 
                                               location.href="user_management.php";
                                           });
                                   </script>
                              <?php
                                    
                                }
    
                      
    
                        }


                        ?>





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

<script src="./script/jscript.js"></script>
<script src="" ></script>
<?php endif ?>
</body>
</html>