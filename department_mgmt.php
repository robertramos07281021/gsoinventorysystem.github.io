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

    <link rel="stylesheet" type="text/css" href="../GSOInvSys/css/department_mgmt.css">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
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
        #deptChangeNameSave{
            box-shadow: 2px 2px 0px 0px #000000;
        }
        #deptChangeNameSave:hover{
            box-shadow:2px 2px 0px 0px #66cc00;
        }
        #deptNewNameButton{
            box-shadow: 2px 2px 0px 0px #000000;
        }
        #deptNewNameButton:hover{
            
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
                        <li class="mb-2 w-full p-3 bg-red-300/20 rounded-md font-bold flex gap-1 items-center "><img src="./image/department.png"  class="bg-white p-1 rounded w-6 h-6">Departments</li>
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
                <p class="font-semibold text-2xl"><a href="user_management_dept.php">Departments</a> / <span class="text-gray-300">Manage Departments</span></p>
                <p class="font-semibold"> Welcome  Admin <span class="font-bold text-xl" ><?php echo ucfirst($row['firstname']) ." ".ucfirst ($row  ['lastname']);?></span></p>
            </div>
            <div class="w-full h-[92.5%] ">
                <div class="w-full h-full gap-6 drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)]">
                    <div class="w-full h-full grid-flow-row-dense grid grid-cols-6 grid-rows-6 gap-6  pt-6">
                        <div class="bg-white col-span-3 rounded-lg p-2 drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)]">

                            <?php
                            //Add Department

                                
                                if(isset($_POST['AddDep'])){

                                    $add_dep = strtoupper(mysqli_real_escape_string($db, $_POST['dept_name']));


                                    $dep = mysqli_query($db, "SELECT * FROM department WHERE dep_name='$add_dep'");
                                    $rows = mysqli_fetch_assoc($dep);
                                    $already_exists = mysqli_num_rows($dep);

                                    if($already_exists > 0){
                                        ?>
                                    <script>
                                        swal({title: "Department already exists!", text: "Please try again. Thank you.", type:"error", icon: "error"})
                                        </script>

                                <?php
                                    }elseif($already_exists == 0){
                                        $merge = "no";
                                        $sql = "INSERT INTO department (dep_name, merge) VALUES ('$add_dep', '$merge')";
                                        mysqli_query($db, $sql);  //insert to database

                                        ?>
                                        <script>
                                            swal({title: "Success!", text: "New Department has been added.", type:"success", icon: "success"})
                                            .then(function(){ 
                                                                location.href="department_mgmt.php";
                                                            });
                                            </script>
    
                                    <?php

                                    }



                                }

                            ?>
                       
                <!-- Add department -->
                            <form class="w-full flex-col flex items-end gap-1" method="POST">
                                <input type="text" class="w-full border-2 pl-1 py-[2px] focus:outline-none border-gray-400 rounded" name="dept_name" placeholder="Department Name">
                                <button type="submit" name="AddDep" class="px-4 py-1 bg-red-500 rounded text-white border border-red-500 font-semibold transition ease-out duration-300 hover:bg-white hover:text-red-500 hover:border-red-500 " id="addDeptButton">Add Department</button>
                            </form>

                        </div>
                        <div class="row-start-2 col-span-3 row-span-5 grid content-between h-full bg-white rounded-lg p-6" >
               
                <!-- Display department -->

                        <div class=" w-full ">
                            <table class="w-full ">
                                <thead>
                                    <tr>
                                        <td class="text-lg pb-5 font-bold" colspan="2">Departments</td>
                                    </tr>
                                </thead>
                                <tbody>

                                
                                <?php   
                                    $num = 0;
                                    while($rowdep = mysqli_fetch_assoc($res_dep)) {
                                    $num++;
                                            if($rowdep['merge']=='no'){
                                ?>
                                    <tr>   <!-- rowsss from database will be displayed -->
                                        <td class="border-b-2 border-gray-100 pt-1"><?php echo $num; ?></td>
                                        <td class="border-b-2 border-gray-100 pt-1"><?php echo $rowdep['dep_name']; ?> </td>
                                        <td class="flex justify-end gap-2 border-b-2 border-gray-100 pt-1"><span class="border-r-2 border-gray-300 px-2">
                                            <a href="department_mgmt.php?id=<?php echo $rowdep['dep_id']; ?>" style="color: green;">Edit</a></span>
                                            <span> <a href="department_mgmt.php?delid=<?php echo $rowdep['dep_id']; ?>" style="color: red;">Delete</span></td>
                                        
                                    </tr>


                                    <?php } 
                                    } //end of while ?>
                                </tbody>
                            </table>
                        </div>
                            <?php      //input text will appear when edit button is selected 

                                        if(isset($_GET['id'])){
                                            $id = $_GET['id'];

                                            $select_dep = mysqli_query($db, "SELECT * FROM department WHERE dep_id='$id'");
                                            $rows = mysqli_fetch_assoc($select_dep);

                                            ?>
                                            <br><br>
                                            
                                                <form method="POST" class="flex gap-5 items-center w-full justify-end">

                                                <!-- Display selected department name -->
                                                <p><?php echo $rows['dep_name']; ?><span>&nbsp;to&nbsp;</span></p>

                                                <input type="text" name="edit_dep" class="w-52 p-1 border-2 border-gray-200 rounded-lg" placeholder="New Department Name">
                                                <button name="edit" class="px-10 py-1 border border-red-500 hover:bg-white hover:text-red-500 transition ease-out duration-300 bg-red-500 text-white font-semibold rounded " id="deptNewNameButton">Save</button>

                                           </form>

                                            
                                    <?php

                                                if(isset($_POST['edit'])){   //if save button is submitted in edit department id

                                                    $edit_dep = strtoupper(mysqli_real_escape_string($db, $_POST['edit_dep']));

                                                    $dep = mysqli_query($db, "SELECT * FROM department WHERE dep_name='$edit_dep'");
                                                    $rows = mysqli_fetch_assoc($dep);
                                                    $already_exists = mysqli_num_rows($dep);

                                                    if($already_exists > 0){
                                                        ?>
                                                    <script>
                                                        swal({title: "Invalid", text: "Please try again. Thank you.", type:"error", icon: "error"})
                                                        </script>
                
                                                <?php
                                                    } elseif($already_exists == 0 && !empty($edit_dep) ){

                                                        mysqli_query($db, "UPDATE department SET dep_name='$edit_dep' WHERE dep_id='$id'");

                                                        ?>
                                                                <script>
                                                                        swal({title: "Updated!", text: "Department has been updated.", type:"success"})
                                                                        .then(function(){ 
                                                                            location.href="department_mgmt.php";
                                                                        });
                                                                </script>
                                                        <?php

                                                    }
                                                
                                                }

                                        } //end of edit 



                                        if(isset($_GET['delid'])){    //delete function
                                            $id = $_GET['delid'];

                                            mysqli_query($db, "DELETE FROM department WHERE dep_id='$id'");

                                            ?>
                                                    <script>
                                                            swal({title: "Removed!", text: "Department has been removed.", type:"success"})
                                                            .then(function(){ 
                                                                location.href="department_mgmt.php";
                                                            });
                                                    </script>
                                            <?php
                                        }
                                    

                                    ?>
                                    
                            
                        </div>
                        <div class="col-start-4 col-span-3 row-span-3 bg-white rounded-lg p-3">
                            <form class="flex h-[100%] flex-col" method="POST" >
                                <p class="text-xl font-semibold pt-2 pl-2">Merge Department</p>
                                <ul class="w-full grid grid-cols-4 mt-2 p-5"> 
                                
                                    <?php 
                                    //display all departments
                                    $disDep = "SELECT * FROM department WHERE merge='no'";
                                    $rdep = mysqli_query($db,$disDep);
                                    while($dprows = mysqli_fetch_assoc($rdep)){
                                        $sel_dept = $dprows['dep_name'];   ?>
                                            
                                                <li class="w-full  flex justify-center">
                                                <input type="checkbox" name="dep[]" id="<?php echo $sel_dept ?>" value="<?php echo $sel_dept ?>">
                                                <label for="<?php echo $sel_dept ?>" class="  w-full ">
                                                <p class="w-full flex items-center ml-2"><?php echo $sel_dept ?></p>
                                                </label>
                                            </li>

                                        <?php
                                    }
                                    
                                    

                                    

                                    
                                    
                                    
                                    
                                    ?>
                                </ul>
                                
                                <div class=" h-full flex items-end ">
                                    <div class="w-full flex justify-between border-t-2 border-gray-200 pt-3">
                                        <input type="text" name="newDepartmentName" placeholder="New Department Name" class="p-1 border-2 border-gray-400 rounded focus:outline-none" size="50">
                                        <button type="submit" name="mergeDep" class="px-14 border border-red-500 text-white bg-red-500 text-lg font-semibold rounded transition ease-out duration-300 hover:bg-white hover:text-red-500 hover:border-red-500" id="logOutButton">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                                    
                                    <?php
                                                        //if new dep name button is submitted
                                            if(isset($_POST['mergeDep'])){
                                                    $newDepName = strtoupper($_POST['newDepartmentName']);

                                                   if(isset($_POST['dep'])){
                                                        if(!empty($newDepName)){   //if checkbox is checked and input text is not empty
                                                             $dep = $_POST['dep'];
                                                            
                                                             $allData = implode(",",$dep);
                                                           $dp =  mysqli_query($db,"INSERT INTO mergedep (m_name, old_dep) VALUES ('$newDepName', '$allData')");
                                                           mysqli_query($db,"INSERT INTO department (dep_name,merge) VALUES ('$newDepName','no')");
                                                         
                                                            foreach ($dep as $newDep){
                                                              
                                                                mysqli_query($db, "UPDATE department SET merge='yes', merge_name='$newDepName' WHERE dep_name='$newDep'");
                                                                ?>
                                                                <script>
                                                                    swal({title: "Merged successfully!", text: "Department merged.", type:"success"})
                                                                    .then(function(){ 
                                                                            location.href="department_mgmt.php";
                                                                        });
                                                                    
                                                            </script>
                                                        <?php 
                                                               
                                            } //for each end
                                           
                                                            
                                                           
                                                        }else{
                                                            ?>
                                                            <script>
                                                                    swal({title: "Invalid! New department name required.", text: "Please enter a new department for merging.", type:"error", icon: "error"});
                                                                    
                                                            </script>
                                                    <?php
                                                        }

                                                    }else{
                                                        ?>
                                                                <script>
                                                                        swal({title: "Invalid!", text: "Please select a department.", type:"error", icon: "error"});
                                                                        
                                                                </script>
                                                        <?php
                                                    }



                                            }

                                    ?>


                        <div class="col-start-4 col-span-3 row-start-4 row-span-3 bg-white rounded-lg p-5">
                           <h3 class="text-xl font-semibold"> Merged Departments </h3>


                        <table class="w-full mt-5 overflow-auto">

                           <?php  
                                //display merge department
                                $mergeDep = mysqli_query($db,"SELECT * FROM mergedep");
                                 $totalDept = mysqli_num_rows($mergeDep);
                                 
                                 if($totalDept != 0 ){ 

                                    ?>
                                     <tr>
                                        <th>ID</th>
                                        <th>New Department</th>
                                        <th>Previous</th>
                                    </tr>


                                <?php
                                $num_merge = 0;
                                while($mdep = mysqli_fetch_assoc($mergeDep)){
                                    $num_merge++;
                                    $new = $mdep['m_name'];
                                    $prev = $mdep['old_dep'];

                                    ?>
                                <tr >
                                    <td class="text-center pt-2 border-b-2 border-gray-100"><?php echo $num_merge;  ?></td>  
                                    <td class="text-center border-b-2 border-gray-100"><?php echo $new;  ?></td>  
                                    <td class="text-center border-b-2 border-gray-100"><?php echo $prev;  ?></td>  
                            
                                </tr>


                                    <?php
                                    
                                    
                                           

                                         }  
                                       
                                        
                                    // $mergeRow = 


                                

                            } //if merge table not empty\
                            else{
                                ?><br>
                                <h3> There are no Merged Departments. </h3>

                                <?php
                            }
                           ?>


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

<script src="../GSOInvSys/script/jscript.js" > 
 </script>
<?php endif ?>
</body>
</html>