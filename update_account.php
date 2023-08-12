<?php include('server.php'); ?>
<?php include('errors.php');  ?> 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
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
        .editFormButton{
            box-shadow: 2px 2px 0px 0px #000000;
        }
        .editFormButton:hover{
            box-shadow:2px 2px 0px 0px #ff4d4d; 
        }
        .profileSaveButton{
            box-shadow: 2px 2px 0px 0px #000000;
        }
        .profileSaveButton:hover{
            box-shadow:2px 2px 0px 0px #66cc00;
        }
        .profileCancelButton{
            box-shadow: 2px 2px 0px 0px #000000;
        }
        .profileCancelButton:hover{
            box-shadow:2px 2px 0px 0px #ff4d4d; 
        }
        
    </style>


    <title>GSO Invsys Sample</title>
</head>
<body class=" text-black w-full h-screen grid grid-cols-5 ">
   


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
                        <li class="mb-2 w-full p-3 hover:bg-red-300/20 rounded-md font-semibold flex gap-1 items-center"><img src="./image/users.png" class="bg-white p-1 rounded w-6 h-6">Users</li>
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
                        <li class="mb-2 w-full p-3 bg-red-300/20 rounded-md font-bold flex gap-1 items-center"><img src="./image/user.png"  class="bg-white p-1 rounded w-6 h-6">My Profile</li>
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

    <?php
        //connect to db and display account details
        $user = $_SESSION['user_id'];
        $sql = "SELECT * FROM users WHERE user_id = '$user'";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
    ?>


    <article class="col-span-4  py-6 pr-6 w-full h-screen col-start-2 ">
        <div class="flex justify-between text-white ">
        <p class="font-semibold text-2xl">My Profile</a></p>
            <p class="font-semibold"> Welcome  Admin <span class="font-bold text-xl" ><?php echo ucfirst($row['firstname']) ." ".ucfirst ($row['lastname']);?></span></p>
        </div>
    
      
        <div class=" grid grid-flow-row-dense grid-cols-3 grid-rows-6 gap-6 h-[92%] mt-5">
            <div class="col-start-3 row-span-3 bg-white drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)] rounded-xl p-6">
                <form method="POST" class="flex flex-col justify-between h-full w-full"> 
                    <div>
                        <p class="w-full text-center pb-2 font-semibold text-2xl">Change Password</p>
                        
                        <div>
                            <label class="font-semibold text-lg">New Password: </label><br>
                            <input type="password" name="change1" class="border-2 border-gray-200 w-full pl-2 p-1 " placeholder="Password" required>
                        </div>
                        <div>
                            <label class="font-semibold text-lg">Confirm Password: </label> <br>
                            <input type="password" name="change2" class="border-2 border-gray-200 w-full pl-2 p-1 " placeholder="Password" required>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <button type="submit" name="change_pass" class="border border-green-500 px-5 py-1 bg-green-500 text-white profileSaveButton rounded transition ease-out duration-300 hover:text-green-500 hover:bg-white">Save</button>
                    </div>
                </form>
            </div>
            <div class="bg-white row-start-1 row-span-6 col-span-2 p-5 h-full col-start-1 drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)] rounded-xl flex flex-col ">
                <div class="flex justify-center ">
                    <img src="https://media.gettyimages.com/id/1180926773/photo/studio-waist-up-portrait-of-a-beautiful-businesswoman-with-crossed-arms.jpg?s=612x612&w=gi&k=20&c=BlCz_Y26FpXviP-1E7P9uISFsbO-W9ducNo0gJ8r9jM="  class="border-4 border-gray-500 h-36 w-[18%] rounded-full   ">
                    <div class=" pt-5 px-5 w-full flex items-center">
                        <div class="w-full">
                            <p class="text-4xl"><?php echo ucfirst($row['firstname']). " " .ucfirst($row['lastname'])?></p>
                            <hr class="border-2 border-[black]/60">
                        </div>
                    </div>
                </div>
                <div class="h-full">
                  
                    <div class="h-full">
                        <!-- php code  -->
                        <?php
                            $errors = array();
                            //update user Account
                            if(isset($_POST['post_update'])){
                            
                                $u_id = $_SESSION['user_id'];
                                $firstname = mysqli_real_escape_string($db, $_POST['firstName']);
                                $lastname = mysqli_real_escape_string($db, $_POST['lastName']);
                                $email = mysqli_real_escape_string($db, $_POST['email']);
                                $address = mysqli_real_escape_string($db, $_POST['address']);
                                $phone = mysqli_real_escape_string($db, $_POST['mobileNum']);
                                $username = mysqli_real_escape_string($db, $_POST['userName']);
                                $pass1 = mysqli_real_escape_string($db, $_POST['up_pass1']);
                                // $pass2 = mysqli_real_escape_string($db, $_POST['up_pass2']);
                                
                                $pass_enc = md5($pass1);
                            //check password is match
                                $sql_pass = "SELECT * FROM users WHERE user_id='$u_id' ";

                                if(count($errors) === 0){

                                        if($pass_enc === $row['password']){

                                    $sql= "UPDATE users SET firstname='$firstname',lastname='$lastname',
                                    email='$email', phone_num='$phone', u_address='$address', username='$username' WHERE user_id='$u_id' ";

                                    mysqli_query($db, $sql);  //update to database
                        ?>
                                        <script>
                                                swal({title: "Success!", text: "Your Account has been updated.", type:"success"})
                                                .then(function(){ 
                                                    location.href="update_account.php";
                                                });
                                        </script>
                                        <?php

                                            }else {
                                                ?>

                                        <script>
                                                swal({title: "Sorry!", text: "Your current password is invalid. Try again.", type:"error", icon: "error"})
                                                // .then(function(){ 
                                                //     location.href="update_account.php";
                                                // });
                                        </script>


                                                <?php

                                            }
                                }
                            }
                        ?>


                        <form class=" w-full  h-full " method="POST">
                            <div class=" h-full grid content-between ">
                                <div class="">
                                    <div class="grid grid-cols-2 gap-5 pt-3 ">
                                        <div>
                                            <label for="firstName" class="font-semibold ">Firstname: </label>
                                            <input type="text" name="firstName" id="firstName" class="border-2 border-gray-200 rounded w-full p-1 pl-2 text-sm " max="50" value="<?php 
                                            if(isset($_POST['post_update'])){
                                                echo $_POST['firstName'];
                                            }else{ echo ucfirst($row['firstname']); } ?>" required disabled>
                                        </div>
                                        <div>
                                            <label for="lastName" class="font-semibold">Lastname: </label>
                                            <input type="text" name="lastName" id="lastName" class="border-2 border-gray-200 rounded w-full p-1 pl-2 text-sm" max="50" value="<?php 
                                            if(isset($_POST['post_update'])){

                                                echo $_POST['lastName'];
                                            }else{
                                                echo ucfirst($row['lastname']); } ?>" required disabled>
                                        </div>
                                    </div>
                                            
                                    <div class="grid grid-cols-2 gap-5 pt-3">
                                        <div>
                                            <label for="email" class="font-semibold ">Email address:</label>
                                            <input type="text" name="email" id="email" class="border-2 border-gray-200 rounded w-full p-1 pl-2 text-sm" value="<?php 
                                            if(isset($_POST['post_update'])){

                                                echo $_POST['email'];
                                            }else{
                                                echo $row['email']; } ?>" required disabled>
                                        </div>
                                        <div>
                                            <label for="mobileNum" class="font-semibold ">Phone Number:</label>
                                            <input type="number" name="mobileNum" id="mobileNum" class="border-2 border-gray-200 rounded w-full p-1 pl-2 text-sm" value="<?php 
                                            if(isset($_POST['post_update'])){

                                            echo $_POST['mobileNum'];
                                        }else{
                                            echo $row['phone_num']; } ?>" required disabled>
                                    </div>
                                </div>

                                <div class="pt-3">
                                    <label for="address" class="font-semibold ">Address:</label>
                                    <input type="text" name="address" id="address" class="border-2 border-gray-200 rounded w-full p-1 pl-2 text-sm " max="30" value="<?php 
                                    if(isset($_POST['post_update'])){
                                        echo $_POST['address'];
                                    }else{ echo $row['u_address']; } ?>" required disabled>
                                </div>

                                <div class="grid grid-cols-2 gap-5 pt-3">
                                    <div>
                                        <label for="userName" class="font-semibold ">Username:</label>
                                        <div class="border-2 border-gray-200 bg-gray-200/20 rounded w-full p-1 pl-2 text-sm"><?php echo $row['username'] ?></div>
                                    </div>
                                    <div>
                                        <label for="role" class="font-semibold ">Role:</label>
                                        <input type="text" name="role" id="role" class="border-2 border-gray-200 rounded w-full p-1 pl-2 text-sm " value="<?php echo $row['role']?>" disabled>
                                    </div>
                                </div>
                                <div class="pt-3">
                                    <label for="department" class="font-semibold">Department:</label>
                                    <select name="department" id="department" class="text-sm border-2 border-gray-200 rounded w-full p-1 pl-1 " >
                                            <?php  
                                                $dp_query = "SELECT * FROM department";
                                                $res_q = mysqli_query($db,$dp_query);
                                                while($deprow = mysqli_fetch_assoc($res_q)){
                                                    ?>

                                                <option value="<?php echo $deprow['dep_name']; ?>" >
                                                <?php echo $deprow['dep_name']; ?>  </option>
                                                    <?php

                                                }

                                            ?>
                                    </select>
                                </div>

                                <div class=" flex grid grid-cols-2 gap-5 pt-3  w-full " id="changePass"  style="display:none;">
                                    <div class=" w-full">
                                        <label for="up_pass1" class="font-semibold ">To save changes, confirm current Password:</label>
                                            
                                        <input type="password" name="up_pass1" id="up_pass1"  class="border-2 border-gray-200 rounded w-full p-1 pl-1 text-sm " placeholder="Password" required>
                                    </div>      
                                </div>
                       
                            </div>
                            <div class="pt-5">
                                <div class="flex justify-center gap-5 hidden" id="saveForm" >
                                    <button class="border border-green-500 px-5 py-1 bg-green-500 text-white profileSaveButton transition ease-out duration-300 rounded hover:text-green-500 hover:bg-white" type="submit" name="post_update" >Save</button>
                                    <div class=" border border-red-500 bg-red-500  text-white font-semibold px-4 py-1 cursor-pointer profileCancelButton transition ease-out duration-300 rounded hover:text-red-500 hover:bg-white" onclick="cancelButton()"  >
                                        Cancel
                                    </div>
                                    
                                </div>

                                <div class="flex justify-center" id="editButton">
                                    <div class="border border-red-500 py-1 cursor-pointer w-32 text-center bg-red-500 rounded text-white font-semibold editFormButton transition ease-out duration-300 hover:text-red-500 hover:bg-white" onclick="editForm()">Edit</div>
                                </div>
                            </div>
                        </form>
                        
                    </div> 
                    
                </div>
                
                
                   <?php

                        //update Password
                        if(isset($_POST['change_pass'])){
                            $u_id = $_SESSION['user_id'];
                            $change1 = mysqli_real_escape_string($db, $_POST['change1']);
                            $change2 = mysqli_real_escape_string($db, $_POST['change2']);

                            $encPass = md5($change1);

                            if($change1 !== $change2){
                                ?>
                                    <script>
                                        swal({title: "Sorry!", text: "Your password does not match. Try again.", type:"error", icon: "error"})
                                    </script>
                                <?php
                            }else if($change1 === $change2 && $encPass === $row['password']){
                                ?>
                                    <script>
                                        swal({title: "Sorry!", text: "Password already used. Please enter a new password.", type:"error", icon: "error"})
                                    </script>
                                <?php
                               
                            }else if($change1 === $change2 && $encPass !== $row['password']){
                                $sql= "UPDATE users SET password='$encPass' WHERE user_id='$u_id' ";
                                mysqli_query($db, $sql);  //update to database
                                 ?>
                                    <script>
                                            swal({title: "Success!", text: "You have changed your password.", type:"success"})
                                            .then(function(){ 
                                                location.href="update_account.php";
                                            });
                                    </script>
                                    <?php

                            }

                        }

                    ?>


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



<!-- Script for hidden textbox -->

<script src="./script/jscript.js"></script>


<script>
function editForm(){
    document.getElementById("saveForm").style.display="flex";
    document.querySelector("#changePass").style.display = "flex";
    document.getElementById("editButton").style.display = 'none';
    document.getElementById("firstName").disabled = false;
    document.getElementById("lastName").disabled = false;
    document.getElementById("email").disabled = false;
    document.getElementById("mobileNum").disabled = false;
    document.getElementById("address").disabled = false;
    document.getElementById("userName").disabled = false;
    document.getElementById("role").disabled = false;
    
}


function cancelButton(){
   location.reload();
}

 function noLogout() {
    document.getElementById("logoutModal").style.display="none";
}

 function logoutModal() {
    document.getElementById("logoutModal").style.display="block";
}




</script>

</body>
</html>