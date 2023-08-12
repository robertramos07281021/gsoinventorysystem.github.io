<?php include('server.php'); 


$displayUser = "SELECT * FROM users";
$res_query = mysqli_query($db,$displayUser);

$total_users = mysqli_num_rows($res_query);
$act = "active";
$active_query= "SELECT * FROM users WHERE status='$act'";
$active_result = mysqli_query($db,$active_query);
$total_active = mysqli_num_rows($active_result);

 
$deactive_result = mysqli_query($db,"SELECT * FROM users WHERE status='deactivated'");
$total_deactive = mysqli_num_rows($deactive_result);

$d1_result = mysqli_query($db,"SELECT * FROM users WHERE mode='online'");
$total_online= mysqli_num_rows($d1_result);

$d2_result = mysqli_query($db,"SELECT * FROM users WHERE mode='offline'");
$total_offline = mysqli_num_rows($d2_result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../GSOInvSys/css/style.css">
    <title>GSO Invsys</title>
    <style>
        .welcomePageBg { 
            background-image: url('./image/welcomeBg.jpg');
        }
        #logoutModal {
            display: none;
        }   
        #registerButton {
            box-shadow:2px 2px 0px 0px #000000 ;
        }
        #registerButton:hover {
            box-shadow:2px 2px 0px 0px #ff4d4d ;
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

<body class=" text-black w-full h-screen grid grid-cols-5 overflow-hidden">

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
        <div class="drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)] h-full w-full rounded-xl bg-white p-8 text-center flex flex-col">
            <a href="index.php" class="text-2xl font-bold"><span class="text-[red]">GSO</span> InvSystem</a>
            <hr class="mt-5 border border-black">
            <div class="text-start w-full mt-10">
                <ul>
                    <a aria-current="page" href="index.php">
                        <li class="mb-2 w-full hover:bg-red-300/20 p-3 rounded-md font-semibold flex gap-1 "><img src="./image/dashboard.png" class="rounded w-6 h-6">Dashboard</li>
                    </a>
                    <a href="user_management.php">
                        <li class="mb-2 w-full p-3 bg-red-300/20 rounded-md font-bold flex gap-1 items-center"><img src="./image/users.png" class="bg-white p-1 rounded w-6 h-6">Users</li>
                    </a>

                    <a href="user_management_dept.php">
                        <li class="mb-2 w-full p-3 hover:bg-red-300/20 rounded-md font-semibold flex gap-1 items-center"><img src="./image/department.png"  class="bg-white p-1 rounded w-6 h-6">Departments</li>
                    </a>
                    

                    <a href="items_page.php">
                        <li class="mb-2 w-full p-3 hover:bg-red-300/20 rounded-md font-semibold flex gap-1 items-center"><img src="./image/packaging.png"  class="bg-white p-1 rounded w-6 h-6">Items</li>
                    </a>

                    <a href="index_approval.php">
                        <li class="mb-2 w-full p-3 hover:bg-red-300/20 rounded-md font-semibold flex gap-1 items-center transition ease-out duration-300"><img src="./image/icons8-approval-48.png"  class="bg-white p-1 rounded w-6 h-6">Manage Approval</li>
                    </a>

                    <a href="reportPage.php">
                        <li class="mb-2 w-full p-3 hover:bg-red-300/20 rounded-md font-semibold flex gap-1 items-center"><img src="./image/report.png"  class="bg-white p-1 rounded w-6 h-6">Reports</li>   
                    </a>

                    <a href="update_account.php">
                        <li class="mb-2 w-full p-3 hover:bg-red-300/20 rounded-md font-semibold flex gap-1 items-center"><img src="./image/user.png"  class="bg-white p-1 rounded w-6 h-6">My Profile</li>
                    </a>
                </ul>  
            </div>
            <div class="flex  h-full w-full items-end">
                <button onclick="logoutModal()" class="font-semibold hover:font-bold w-full  items-center py-2 pl-2 flex rounded-md hover:bg-red-300/20 hover:pr-2"><img src="./image/icons8-logout-64.png" alt="logut" width="20" height="20"><p class="flex items-center">Log Out</p></button>
            </div>
        </div>
    </nav>
    
    <div class=" absolute top-0 left-0 -z-10 h-80 w-full welcomePageBg">
        
    </div>

    <nav>
    
    </nav>
    
    <article class=" col-span-4 pt-6 pr-6 w-full ">
        
        <div class="flex justify-between text-white ">
            <p class="font-semibold text-2xl "><a href="user_management.php">Users</a> / <span class="text-gray-300">Create Account</span></p>
            <p class="font-semibold"> Welcome  Admin <span class="font-bold text-xl" ><?php echo ucfirst($_SESSION['firstname']) ." ".ucfirst ($_SESSION['lastname']);?></span></p>
        </div>

    

        <div class="grid grid-cols-5 grid-flow-row-dense grid-rows-5  mt-6 gap-6">
            <div class="col-span-3 row-span-5 bg-white  h-full  rounded-xl drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)] ">
                    <div class=" h-full px-3 pt-3 " >
                        <div class=" flex justify-center w-full ">
                            <div>
                                <p class="text-xl font-semibold">Create Account</p>
                                <div class="flex justify-center">
                                <p class="text-xs text-white">p<p>
                            <?php if(count($errors) > 0){?>
                                <p class="text-xs text-center text-red-500">All fields are required</p>
                            <?php } ?>
                                <p class="text-xs text-white">p<p>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="create_account.php"  class="w-full  px-3 pt-3 pb-6 h-full" novalidate>
                            <div class="w-full grid grid-cols-2 gap-4">
                                <div class="">
                                    <label class="text-sm font-bold" for="firstname">First Name:</label>
                                    <input type="text" name="firstname" id="firstname" onchange="accountGenerate()" value="<?php if(isset($_POST['submit'])){ echo $firstname; } else { echo "";} ?>"  required class="w-full border-b border-l border-black/50 rounded-bl-md pl-1 focus:outline-none focus:border-b-2 focus:border-l-2 focus:rounded-bl-md <?php 
                                    if(isset($_POST['submit'])) {
                                        if(strlen(trim($firstname))==0 || empty($firstname)) { 
                                            echo "border-red-500 "; 
                                        } else {
                                            echo "border-l-2 border-b-2 border-green-500";
                                        }
                                    } ?>" placeholder="Firstname">
                                </div>
                                <div>
                                    <label class="text-sm font-bold" for="lastname">Last Name:</label>
                                    <input type="text" name="lastname" id="lastname" onchange="accountGenerate()" value="<?php if(isset($_POST['submit'])){ echo $lastname; } else { echo "";} ?>" required class="w-full border-b border-l border-black/50 rounded-bl-md pl-1 focus:outline-none focus:border-b-2 focus:border-l-2 focus:rounded-bl-md <?php 
                                    if(isset($_POST['submit'])) {
                                        if(strlen(trim($lastname))==0 || empty($lastname)) { 
                                            echo "border-red-500"; 
                                        } else {
                                            echo "border-l-2 border-b-2 border-green-500";
                                        }
                                    } ?>" placeholder="Lastname">
                                </div>
                            </div>    
                            <div class="mt-2">
                                <label class="text-sm font-bold" for="email">Email:</label>
                                <input type="email" name="email" value="<?php if(isset($_POST['submit'])){ echo $email; } else { echo "";} ?>" required class=" w-full border-b border-l border-black/50 rounded-bl-md pl-1 focus:outline-none focus:border-b-2 focus:border-l-2 focus:rounded-bl-md <?php 
                                    if(isset($_POST['submit'])) {
                                        if(strlen(trim($email))==0 || empty($email)) { 
                                            echo "border-red-500"; 
                                        } else {
                                            echo "border-l-2 border-b-2 border-green-500";
                                        }
                                    } ?>" placeholder="Email">
                            </div>
                            <div class="mt-2">
                                <label class="text-sm font-bold" for="phone">Contact number:</label>
                                <input id="mobileNum" type="number" name="phone" value="<?php if(isset($_POST['submit'])){ echo $phone; } else { echo "";} ?>" required class="w-full border-b border-l border-black/50 rounded-bl-md pl-1 focus:outline-none focus:border-b-2 focus:border-l-2 focus:rounded-bl-md <?php 
                                    if(isset($_POST['submit'])) {
                                        if(strlen(trim($phone))==0 || empty($phone)) { 
                                            echo "border-red-500"; 
                                        } else {
                                            echo "border-l-2 border-b-2 border-green-500";
                                        }
                                    } ?>" placeholder="Mobile Number">
                            </div>
                            <div class="mt-2">
                                <label for="address" class="text-sm font-bold">Address:</label>
                                <input type="text" name="address" value="<?php if(isset($_POST['submit'])){ echo $address; } else { echo "";} ?>" required class="w-full border-b border-l border-black/50 rounded-bl-md pl-1 focus:outline-none focus:border-b-2 focus:border-l-2 focus:rounded-bl-md <?php 
                                    if(isset($_POST['submit'])) {
                                        if(strlen(trim($address))== 0 || empty($address)) { 
                                            echo "border-red-500"; 
                                        } else {
                                            echo "border-l-2 border-b-2 border-green-500";
                                        }
                                    } ?>" placeholder="Address">
                            </div>
                                
                            <div class="mt-2">   
                                <label for="department" class="text-sm font-bold">Department:</label>
                                <select name="department" id="department" value="<?php if(isset($_POST['submit'])){ echo $department; } else { echo $department=""; }?>" class="w-full border-b border-l border-black/50 rounded-bl-md pl-1 focus:outline-none focus:border-b-2 focus:border-l-2 focus:rounded-bl-md appearance-none <?php 
                                    if(isset($_POST['submit'])) {
                                        if(trim($errors[array_search("department",$errors)]) == 0 || empty($department)) {
                                            echo "border-red-500";
                                        } else {
                                            echo "border-l-2 border-b-2 border-green-500";
                                        }
                                    }
                                ?>" required>
                                        <option value="" <?php if($department == "" ) { echo "selected";}?> >Select Department</option>
                                    <?php if(count($deptChoice) > 0 ) {?>
                                        <?php foreach($deptChoice as $deptChoices) { ?>
                                        <option value="<?php echo $deptChoices ?>" <?php if($department == $deptChoices) { echo "selected";} ?>><?php echo $deptChoices ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mt-3" >
                                <p class="font-bold text-sm">Role:</p>
                                <div class="flex items-center pl-2">
                                    <input type="radio" id="userAccount" name="accountRole" class="mr-2" value="user" 
                                    <?php  if(isset($_POST['submit'])){ 
                                        if($role === "user"){
                                            echo "checked";
                                        } else if($role !== "user"){
                                            echo "";
                                        }
                                    }else {
                                        echo "checked";
                                    }  ?>>
                                    <label for="userAccount">User</labal>
                                    <input type="radio" id="adminAccount" name="accountRole" class="ml-2" value="admin" 
                                    <?php  if(isset($_POST['submit'])){ 
                                        if($role === "admin"){
                                            echo "checked";
                                        } else if($role !== "admin"){
                                            echo "";
                                        }
                                    } ?>    >
                                    <label for="adminAccount">Admin</labal>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="flex gap-2">
                                    <label for="username" class="text-sm font-bold">Preferred Username:</label>
                                    <?php 
                                    if(isset($_POST['submit'])){
                                        $user_query = "SELECT * FROM users WHERE username='$username'";
                                        $user_query_run = mysqli_query($db, $user_query);
                                        if(mysqli_num_rows($user_query_run) > 0) { 
                                        
                                    ?>  
                                        <p class="text-xs self-center text-red-500">Username is already exist</p>
                                    <?php } }?>
                                     </div>
                                <input type="text" name="username" id="username" value="<?php if(isset($_POST['submit'])){ echo $username; } else { echo "";}?>" required  class="w-full border-b border-l border-black/50 rounded-bl-md pl-1 focus:outline-none focus:border-b-2 focus:border-l-2 focus:rounded-bl-md appearance-none
                                <?php  
                                    $user_query = "SELECT * FROM users WHERE username='$username'";
                                    $user_query_run = mysqli_query($db, $user_query);
                                        
                                    if(isset($_POST['submit'])) {
                                        if((strlen(trim($username))==0 || empty($username)) || (mysqli_num_rows($user_query_run) > 0)) { 
                                            echo "required:border-red-500"; 
                                        } else {
                                            echo "border-l-2 border-b-2 border-green-500";
                                        }
                                    } 
                                ?>" placeholder="Username">
                            </div>
                    
                            <div class="grid grid-cols-2 gap-2 mt-5">
                                <div>
                                    <label for="password_1" class="text-sm font-bold">Password:</label>
                                    <input type="password" name="password_1" value="<?php if(isset($_POST['submit'])){ echo $password1; } else { echo "";} ?>" required  class="w-full border-b border-l border-black/50 rounded-bl-md pl-1 focus:outline-none focus:border-b-2 focus:border-l-2 focus:rounded-bl-md appearance-none
                                    <?php 
                                        if(isset($_POST['submit'])) {
                                            if((strlen(trim($password1))==0 || empty($password1)) || (strlen(trim($password1)) < 8 || strlen(trim($password1)) > 16) ) { 
                                                echo "required:border-red-500"; 
                                            } else if ( strlen(trim($password1)) >= 8 && strlen(trim($password1)) <= 16){
                                                echo "border-l-2 border-b-2 border-green-500";
                                            }
                                        } 
                                    ?> " placeholder="Password">
                                    <div class="flex">
                                        
                                    <?php 
                                        if(isset($_POST['submit'])) {
                                            if(strlen(trim($password1)) < 8 || strlen(trim($password1)) > 16) { ?>
                                              <p class="text-xs text-red-500">Should be 8-16 characters</p>
                                            <?php }  else {
                                                echo "";
                                            }
                                        } 
                                    ?>
                                    <p class="text-xs text-white">p</p>
                                    </div>
                                </div>
                                <div>
                                    <label for="password_2" class="text-sm font-bold">Confirm Password:</label>
                                    <input type="password" name="password_2" value="<?php if(isset($_POST['submit'])){ echo $password2; } else { echo "";} ?>" required class="w-full border-b border-l border-black/50 rounded-bl-md pl-1 focus:outline-none focus:border-b-2 focus:border-l-2 focus:rounded-bl-md appearance-none
                                    <?php 
                                        if(isset($_POST['submit'])) {
                                            if($password1 !== $password2 || strlen(trim($password2))==0 || empty($password2)) {                                         
                                                echo "required:border-red-500"; 
                                            } else {
                                                echo "border-l-2 border-b-2 border-green-500";
                                            }
                                        }
                                    ?>">
                                    <?php
                                        if(isset($_POST['submit'])) {
                                            if($password1 !== $password2) { 
                                                echo    '<p class="text-xs text-red-500">Password does match!</p>';
                                            } else {
                                                echo "";
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="mt-12">   
                                <button type="submit" name="submit" class="w-full bg-red-500 border border-red-500 p-1 text-white font-semibold rounded  transition ease-out duration-300 hover:bg-white hover:text-red-500 focus:bg-white focus:text-red-500 " id="registerButton" >Register</button>
                            </div>
                        </form>
                    </div>    
               
                
            </div>

            <div class="col-span-2 row-span-5 ">
                <div class="w-full h-full grid grid-flow-row-dense grid-rows-5 grid-cols-2 gap-6">
                    <div class="bg-white rounded-xl drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)]">
<!-- pa display po ng total account user kasama ung inactive user -->
<center> <b>  Total  Deactivated user </b> <br><br>
<?php echo $total_deactive;  ?></center>


                    </div>

                    <div class="bg-white rounded-xl drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)]">
<!-- pa display po ng total active user -->
                                        <center> <b>Total active user </b> <br><br>
                                         <?php echo $total_active;  ?></center>


                    </div>

                    <div class="row-start-2 row-span-2 bg-white col-span-2 rounded-xl drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)] w-full">

<!-- pa display po ung department tapos palagyan ng total account ng department -->
                                            
                        <table class="w-full">
                            <thead>
                            <tr>
                                <th>
                                   Total Users
                                </th>
                                <th>
                                    User Online
                                </th>
                                <th>
                                    User Offline
                                </th>
                            </tr>  
                            </thead> 
                            <tbody>
                                <tr>
                                    <td class="text-center"><?php echo $total_users; ?></td>
                                    <td class="text-center"><?php echo $total_online; ?></td>
                                    <td class="text-center"><?php echo $total_offline; ?></td>
                                    
                                </tr>
                            </tbody>
                                

                        </table>
                                        

                    </div>
                                            

                </div>
            </div>

        </div>
    </article>

    <div class="absolute top-0 left-0 h-full w-full bg-white/30 backdrop-blur-sm" id="logoutModal" >
        <div class="flex w-full h-full justify-center items-center">
            <div class="h-56 w-80 fixed rounded drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)]" >
                <div class="bg-white h-full w-full flex flex-col rounded-md">
                    <p class="text-black font-bold pl-2 py-2 self-start  w-full flex "><img src="./image/icons8-logout-64.png" alt="logut" width="20" height="20">Log Out</p>
                    <div class="text-center flex flex-col justify-center border  w-full h-full">
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