<?php include('server.php'); 

$id_view = $_GET['id'];
$view_q = mysqli_query($db, "SELECT * FROM users WHERE user_id='$id_view'");
$row_view = mysqli_fetch_array($view_q);

$deptChoice = array("HR","SB","ACCOUNTING","GSO/BAC","RHU","BFP","PNP","MCR","BUDGET","MTO","BPLO","MPDO","ENGINEERING","COMELEC","BIR","ASSESOR","DILG","MSWDO","MENDO","DA","MDDRRMO","MDRRMO");


$errors = array();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="./css/style.css">

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

        .buttons{
            box-shadow: 2px 2px 0px 0px #000000;
        }
        .buttons:hover{
            box-shadow:2px 2px 0px 0px #ff4d4d; 
        }

        #saveButton{
            box-shadow: 2px 2px 0px 0px #000000;
        }
        #saveButton:hover{
            box-shadow:2px 2px 0px 0px #66cc00;
        }
        #changePass{
            box-shadow:2px 2px 0px 0px #ff4d4d; 
        }
        #changePass:hover{
            box-shadow: 2px 2px 0px 0px #000000;
        }
        


    </style>
  
</head>

<body class=" text-black w-full h-screen grid grid-cols-5">

   

    <?php 
    if (isset($_SESSION['username'])): 
    ?>

<!-- Navbar -->
<nav class=" p-6 fixed h-full w-[20%]">
        <div class="drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)] h-full w-full rounded-xl bg-white p-8 text-center flex flex-col">
            <a href="index.php" class="text-2xl font-bold"><span class="text-[red]">GSO</span> InvSystem</a>
            <hr class="mt-5 border border-black">
            <div class="text-start w-full mt-10">
                <ul>
                    <a aria-current="page" href="index.php">
                        <li class="mb-2 w-full hover:bg-red-300/20 p-3 rounded-md font-semibold flex gap-1 transition ease-out duration-300 "><img src="./image/dashboard.png" class="rounded w-6 h-6">Dashboard</li>
                    </a>
                    <a href="user_management.php">
                        <li class="mb-2 w-full p-3 bg-red-300/20 rounded-md font-bold flex gap-1 items-center transition ease-out duration-300"><img src="./image/users.png" class="bg-white p-1 rounded w-6 h-6">Users</li>
                    </a>

                    <a href="user_management_dept.php">
                        <li class="mb-2 w-full p-3 hover:bg-red-300/20 rounded-md font-semibold flex gap-1 items-center transition ease-out duration-300"><img src="./image/department.png"  class="bg-white p-1 rounded w-6 h-6">Departments</li>
                    </a>
                    

                    <a href="items_page.php">
                        <li class="mb-2 w-full p-3 hover:bg-red-300/20 rounded-md font-semibold flex gap-1 items-center transition ease-out duration-300"><img src="./image/packaging.png"  class="bg-white p-1 rounded w-6 h-6">Items</li>
                    </a>

                    <a href="report.php">
                        <li class="mb-2 w-full p-3 hover:bg-red-300/20 rounded-md font-semibold flex gap-1 items-center transition ease-out duration-300"><img src="./image/report.png"  class="bg-white p-1 rounded w-6 h-6">Reports</li>   
                    </a>

                    <a href="update_account.php">
                        <li class="mb-2 w-full p-3 hover:bg-red-300/20 rounded-md font-semibold flex gap-1 items-center transition ease-out duration-300"><img src="./image/user.png"  class="bg-white p-1 rounded w-6 h-6">My Profile</li>
                    </a>
                </ul>  
            </div>
            <div class="flex  h-full w-full items-end">
                <button onclick="logoutModal()" class="font-semibold hover:font-bold w-full items-center py-2 pl-2 flex rounded-md hover:bg-red-300/20 hover:pr-2 transition ease-out duration-300"><img src="./image/icons8-logout-64.png" alt="logut" width="20" height="20"><p class="flex items-center">Log Out</p></button>
            </div>
        </div>
    </nav>
    
    <div class=" absolute top-0 left-0 -z-10 h-80 w-full welcomePageBg">
        
    </div>

    <nav>
    
    </nav>

    <article class=" col-span-4 py-6 pr-6 w-full h-screen  ">
        
        <div class="flex justify-between text-white ">
            <p class="font-semibold text-2xl "><a href="user_management.php">Users</a> / <span class="text-gray-300">User Profile</span></p>
            <p class="font-semibold"> Welcome  Admin <span class="font-bold text-xl" ><?php echo ucfirst($_SESSION['firstname']) ." ".ucfirst ($_SESSION['lastname']);?></span></p>
        </div>

       

        <div class="grid grid-flow-row-dense grid-cols-6 h-[95.5%]  grid-rows-6 mt-6 pb-6 gap-6">
            <div class="col-span-3 row-span-6 h-full bg-white rounded-xl drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)] ">
                
                <div class="flex flex-col h-full ">
                    <div class=" flex justify-center  items-center border-b-2 border-gray-500">   
                        <div class="text-center  w-full flex flex-row items-center">
                            <img src="https://static.vecteezy.com/system/resources/previews/002/002/403/original/man-with-beard-avatar-character-isolated-icon-free-vector.jpg" class="w-44 h-44 rounded-xl">
                            <p class="ml-5 text-3xl font-semibold"><?php echo ucfirst($row_view['firstname'])." ". ucfirst($row_view['lastname']); ?></p>
                        </div>
                    </div>
                    
                    <div class=" flex flex-col justify-center h-full ">             
                        <div class="px-10  h-full   " id="detailDiv">
                            <div class="h-full w-full flex flex-col grid content-between">
                                <div>
                                    <p class="mt-4 mb-5">Address: <?php echo $row_view['u_address']; ?> </p> 
                                    <p class="mb-5">Email: <?php echo $row_view['email']; ?> </p>  
                                    <p class="mb-5">Phone: <?php echo $row_view['phone_num']; ?> </p>  
                                    <p class="mb-5">Username: <?php echo $row_view['username']; ?> </p> 
                                    <p class="mb-5">Department: <?php echo $row_view['department']; ?> </p> 
                                    <p class="mb-5">Role: <?php echo $row_view['role']; ?> </p>  
                                    <p class="mb-5">Status: <?php echo $row_view['status']; ?> </p>
                                </div>
                                <div class=" flex justify-start items-end text-white font-semibold">
                                    <button class="py-1 w-32  bg-red-500 rounded-lg buttons border-red-500 border hover:bg-white hover:text-red-500 hover:border-red transition ease-out    duration-300 mb-6" onclick="editDetails()" id="editButton">Edit</button>
                                </div>
                            </div>
                        </div>

                        <!--------------------------------edit division --------------------------------------->
                        <div id="editDiv"  style="display:none" class="px-10 w-full h-full pt-4 pb-6 ">
                            <form action="" class="w-full h-full flex flex-col grid content-between" method="POST">
                                <div>
                                    <div class="flex w-full gap-5">
                                        <div>
                                            <label for="firstName">Firstname:</label>
                                            <input type="text" name="firstName" id="firstName" class="border w-full"
                                            value="<?php if(isset($_POST['saveButton'])){ echo $_POST['firstName']; }else{
                                                echo $row_view['firstname'];
                                            } ?>">
                                        </div>
                                        <div>
                                            <label for="lastName">Lastname:</label>
                                            <input type="text" name="lastName" id="lastName" class="border w-full"
                                            value="<?php if(isset($_POST['saveButton'])){ echo $_POST['lastName']; }else{
                                                echo $row_view['lastname'];
                                            } ?>">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="address">Address:</label>
                                        <input type="text" name="address" id="address" class="border w-full" 
                                        value="<?php if(isset($_POST['saveButton'])){ echo $_POST['address']; }else{
                                                echo $row_view['u_address'];
                                            } ?>">
                                    </div>
                                    <div>
                                        <label for="email">Email:</label>
                                        <input type="text" name="email" id="email" class="border w-full" 
                                        value="<?php if(isset($_POST['saveButton'])){ echo $_POST['email']; }else{
                                                echo $row_view['email'];
                                            } ?>">
                                    </div>
                                    <div>
                                        <label for="phoneNum">Phone:</label>
                                        <input type="number" name="phoneNum" id="phoneNum" class="border w-full"
                                        value="<?php if(isset($_POST['saveButton'])){ echo $_POST['phoneNum']; }else{
                                                echo $row_view['phone_num'];
                                            } ?>">
                                    </div>
                                    <div class="mt-2">
                                        <p>Username: <span><?php echo $row_view['username']; ?></span></p>
                                    </div>

                                    <!-- Department -->
                                    <div>
                                    <label for="department">Department:</label>
                                    <select name="department" id="department" class="border w-full">
                                            <?php if(isset($_POST['saveButton'])){ 
                                                $dep_query = mysqli_query($db, "SELECT * FROM department WHERE merge='no'");
                                                while($deprows = mysqli_fetch_assoc($dep_query)){
                                        ?>
                                                <option value="<?php echo $deprows['dep_name'] ?>" <?php if($_POST['department']===$deprows['dep_name']){
                                                    echo "selected";
                                                }else { echo ""; } ?> ><?php echo $deprows['dep_name'] ?> </option> 
                                        <?php }
                                                ?>
                                                    
                                                <?php
                                            }else{ ?>
                                    
                                        <!-- <option value="select">Select Department</option> -->

                                        <?php 
                                                $dep_query = mysqli_query($db, "SELECT * FROM department WHERE merge='no'");
                                                while($deprows = mysqli_fetch_assoc($dep_query)){
                                        ?>
                                                <option value="<?php echo $deprows['dep_name'] ?>" <?php if($row_view['department']===$deprows['dep_name']){
                                                    echo "selected";
                                                }else { echo ""; } ?> ><?php echo $deprows['dep_name'] ?> </option> 
                                        <?php }  } ?>
                                    </select>

                                    </div>


                                    <div class="flex mt-2">
                                        <p>Roles:</p>
                                        <div class="flex gap-6 ml-3">
                                            <div>
                                                <input type="radio" name="roles" id="users" value="user" <?php if(isset($_POST['saveButton'])){
                                                        if($_POST['roles'] === 'user' ){
                                                            echo "checked";
                                                        }else{ echo "";}
                                                 }elseif($row_view['role'] === 'user'){ echo "checked" ;}else { echo ""; }
                                                 ?>>
                                                <label for="users" name="roles">User</label>
                                            </div>
                                            <div>
                                                <input type="radio" name="roles" id="admin" value="admin" <?php if(isset($_POST['saveButton'])){
                                                        if($_POST['roles'] === 'admin' ){
                                                            echo "checked";
                                                        }else{ echo "";}
                                                 }elseif($row_view['role'] === 'admin'){ echo "checked" ;}else { echo ""; }
                                                 ?>>
                                                <label for="admin" name="roles">Admin</label>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-1">
                                        <p>Status: <?php if($row_view['status']==='inactive'){?><span style="color: red; font-weight:600;"> <?php echo ucfirst($row_view['status']);
                                         ?> </span> <?php } elseif($row_view['status']==='active'){?> <span style="color: green; font-weight:600;"> 
                                         <?php echo ucfirst($row_view['status']);} ?> </span>  
                                         </p>
                                    </div>
                                </div>


                                        
                            
                                <div class="text-white font-semibold flex justify-between  gap-6 mt-1">
                                    <div class="flex gap-6">
                                        <button class="py-1 w-32 bg-green-500 rounded-lg  border-green-500 border hover:bg-white hover:text-green-500  hover:border-green transition ease-out duration-300" id="saveButton"
                                        name="SaveEdit">
                                           Save</button>
                                        <div class="py-1 w-32  bg-red-500 rounded-lg  buttons border-red-500 border hover:bg-white hover:text-red-500 hover:border-red transition ease-out duration-300 text-center cursor-pointer" onclick="cancelEdit()" id="cancelButton">
                                        Cancel</div>
                                    </div>
                                    <!-- <div>
                                        <div class="py-1 w-52  bg-white rounded-lg text-red-500 border-red-500 border hover:bg-red-500 hover:text-white hover:border-red transition ease-out duration-300 text-center cursor-pointer" id="changePass" onclick="changePassword()">Change Password</div>
                                    </div> -->

                                </div>
                            </form>

                            <?php       //Edit user 

                                if(isset($_POST['SaveEdit'])){

                                    $firstname = mysqli_real_escape_string($db, $_POST['firstName']);
                                    $lastname = mysqli_real_escape_string($db, $_POST['lastName']);
                                    $address = mysqli_real_escape_string($db, $_POST['address']);
                                    $email = mysqli_real_escape_string($db, $_POST['email']);
                                    $phoneNum = mysqli_real_escape_string($db, $_POST['phoneNum']);
                                    $department = mysqli_real_escape_string($db, $_POST['department']);
                                    $role = mysqli_real_escape_string($db, $_POST['roles']);

                                    if(!empty($firstname) && !empty($lastname) && !empty($address) && !empty($email) &&
                                    !empty($phoneNum) && !empty($department)){
                                        $sql= "UPDATE users SET firstname='$firstname',lastname='$lastname',
                                        email='$email', phone_num='$phoneNum', u_address='$address', department='$department', role='$role' WHERE user_id='$id_view' ";
    
                                        mysqli_query($db, $sql);  //update to database

                                        ?>
                                        <script>
                                                swal({title: "Success!", text: "User info has been updated.", type:"success"})
                                                .then(function(){ 
                                                    location.href="user_edit.php?id=<?php echo $id_view; ?>";
                                                });
                                        </script>

                                    <?php
                                    }else {
                                        ?>
                                          <script>
                                                swal({title: "Sorry!", text: "Please complete the form.", type:"error", icon: "error"})
                                                // .then(function(){ 
                                                //     location.href="update_account.php";
                                                // });
                                        </script>

                                <?php
                                    }
                                }



                                ?>




                        </div>
                        <!--------------------------- Change Password division ----------------------------------------->
                        <div id="changePassword" class="hidden h-full w-full px-10 py-6" >
                            <form action="" class="flex flex-col justify-between h-full w-full">
                                <div class=" w-full h-[95%] flex justify-center items-center">
                                    <div class="w-[50%]">
                                        <div class="w-full">
                                            <label for="newPassword">New Password:</label>
                                            <input type="text" name="newPassword" id="newPassword" class="w-full border">
                                        </div>
                                        <div class="w-full">
                                            <label for="oldPassword">Old Password:</label>
                                            <input type="password" name="oldPassword" id="oldPassword" class="w-full border">
                                        </div>
                                        <div class="w-full">
                                            <label for="confirmOldPassword">Confirm Old Password:</label>
                                            <input type="password" name="confirmOldPassword" id="confirmOldPassword" class="w-full border">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex gap-6 text-white font-semibold justify-center">
                                    <button class="py-1 w-32 bg-green-500 rounded-lg  border-green-500 border hover:bg-white hover:text-green-500  hover:border-green transition ease-out duration-300" id="saveButton">Save</button>
                                    <div class="py-1 w-32  bg-red-500 rounded-lg  buttons border-red-500 border hover:bg-white hover:text-red-500 hover:border-red transition ease-out duration-300 text-center cursor-pointer" onclick="cancelChangePass()" id="cancelButton">Cancel</div>
                                </div>        
                                
                            </form>
                        </div>
                      
                    </div>
                    
                        
                </div>  
                

            </div>
            <div class="col-start-4 row-span-6 col-span-3 bg-white drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)] rounded-xl">
                <!------------- paki display po dito ung item na nakuha ni user -->











                
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


<script src="./script/jscript.js"></script>

<script>
    function editDetails() {
    document.getElementById("detailDiv").style.display="none";
 
    document.getElementById("editDiv").style.display="block";
    

}

function cancelEdit(){
    location.reload();
}

function changePassword(){
    document.getElementById("detailDiv").style.display="none";
    document.getElementById("changePassword").style.display="block";
    document.getElementById("editDiv").style.display="none";
}

function cancelChangePass(){
    location.reload();
}
</script>
<?php endif ?>
</body>
</html>