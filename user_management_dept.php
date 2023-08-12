<?php include('server.php'); 

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

        #manageDepartments{
            box-shadow: 2px 2px 0px 0px black;
        }
        #manageDepartments:hover{
            box-shadow: 2px 2px 0px 0px white;
        }
        #depView{
            box-shadow: 2px 2px 0px 0px black;
        }
        #depView:hover{
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
                        <li class="mb-2 w-full hover:bg-red-300/20 p-3 rounded-md font-semibold flex gap-1 transition ease-out duration-300"><img src="./image/dashboard.png" class="rounded w-6 h-6">Dashboard</li>
                    </a>
                    <a href="user_management.php">
                        <li class="mb-2 w-full p-3 hover:bg-red-300/20 rounded-md font-semibold flex gap-1 items-center transition ease-out duration-300"><img src="./image/users.png" class="bg-white p-1 rounded w-6 h-6">Users</li>
                    </a>

                    <a href="user_management_dept.php">
                        <li class="mb-2 w-full p-3 bg-red-300/20 rounded-md font-bold flex gap-1 items-center"><img src="./image/department.png"  class="bg-white p-1 rounded w-6 h-6">Departments</li>
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
                <button onclick="logoutModal()" class="font-semibold hover:font-bold w-full items-center  py-2 pl-2 flex rounded-md hover:bg-red-300/20 hover:pr-2 transition ease-out duration-300"><img src="./image/icons8-logout-64.png" alt="logut" width="20" height="20"><p class="flex items-center">Log Out</p></button>
            </div>
        </div>
    </nav>
    
    <div class=" absolute top-0 left-0 -z-10 h-80 w-full welcomePageBg">
    </div>

    <nav class="p-6 ">
    </nav>

    <article class=" col-span-4 pt-6 pb-7 pr-6 ">
        
        <div class="flex justify-between text-white">
            <p class="font-semibold text-2xl flex flex-cols">Departments</p>
            <p class="font-semibold"> Welcome  Admin <span class="font-bold text-xl" ><?php echo ucfirst($_SESSION['firstname']) ." ".ucfirst($_SESSION['lastname']);?></span></p>
        </div>
        <div class="grid grid-flow-row-dense grid-cols-6 grid-rows-3  pt-6 h-full">
                <div class="col-span-3  h-full "> 
                    <div class="rounded-xl drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)]  grid gap-6 mt-3">
                        <a href="department_mgmt.php" class="w-full">
                            <button class=" bg-white text-black font-bold rounded drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)] text-center p-2 hover:bg-gray-700 hover:text-white transition ease-out duration-500" id="manageDepartments">
                                Manage Departments
                            </button>
                        </a>    
                        <div class="bg-white  rounded-xl p-3">
                            <p class="font-bold text-lg">DEPARTMENT:</p>
                            <form method="POST">
                                <select class="w-full p-1 border-t border-black font-semibold outline-0" id="deptSelect" name="selectDep">
                                    <option value="">Select Department</option>
                                    <?php
                                        while($dp_row = mysqli_fetch_assoc($res_dep)){
                                            $sel_dept = $dp_row['dep_name'];
                                            ?>
                                                <option value="<?php  echo $sel_dept; ?>"> <?php  echo $sel_dept; ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                                <div class="flex items-end ">
                                    <button name="depView" type="submit" class="w-full bg-red-500 font-semibold rounded text-white  text-center p-2 hover:bg-white hover:text-red-500 hover:border border border-red-500 hover:border-red-500 transition  duration-300" id="depView">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>    
                </div>
        

                <!-- paki lagay po dito ung mga items na naka specific na department -->

            <div class="col-span-3 row-span-3 mb-7 ml-6">
                <div class="col-span-3 h-full bg-white rounded-xl drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)] p-10 ">
                    <div class="h-full">
                    <table class="w-full" id="itemTable">
                            <thead>
                                <tr>
                                    <th class="pb-3">ID</th>
                                    <th class="pb-3">Item Name</th>
                                    <th class="pb-3">Property Code</th>
                                    <th class="pb-3">End User</th>
                                    <th class="pb-3">Description</th>
                                    <th class="pb-3">Department</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                               

                                // Assuming $db is your database connection
                                $res_item_query = mysqli_query($db, "SELECT * FROM items");

                                if ($res_item_query && mysqli_num_rows($res_item_query) > 0) {
                                    $num1 = 0;
                                    while ($row = mysqli_fetch_assoc($res_item_query)) {
                                        $num1++;
                                        // Code to display the items inside the loop
                                        echo "<tr class='border-b' data-department='" . (isset($row['dep_name']) ? ucfirst($row['dep_name']) : '') . "'>";
                                        echo "<td class='text-center py-2'>" . $num1 . "</td>";
                                        echo "<td class='text-center py-2'>" . ucfirst($row['item_name']) . "</td>";
                                        echo "<td class='text-center py-2'>" . ucfirst($row['property_code']) . "</td>";
                                        echo "<td class='text-center py-2'>" . ucfirst($row['end_user']) . "</td>";
                                        echo "<td class='text-center py-2'>" . ucfirst($row['description']) . "</td>";
                                        echo "<td class='text-center py-2'>" . (isset($row['dep_name']) ? ucfirst($row['dep_name']) : '') . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "No items found.";
                                }

                             
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

    <!-- paki lagay po dito ung mga Users na naka specific na department -->
            <div class="row-start-2 row-span-2 col-span-3 mb-7">
                <div class="bg-white rounded-xl drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)] h-full p-10">
                <table class="w-full" id="userTable">
                        
                            <?php
                                
                            if(isset($_POST['depView'])){
                                $dept = strtoupper($_POST['selectDep']);

                                if(empty($dept)){
                                    ?>
                                    <script>
                                        swal({title: "Invalid!", text: "Please select a department.", type:"error", icon: "error"})
                                        </script>

                                <?php
                                }elseif(!empty($dept)){
                                    $display = "SELECT * FROM users WHERE department='$dept'";
                                   
                                    $query = mysqli_query($db,$display);

                                    $total_users = mysqli_num_rows($query);

                                    if($total_users !=0){

                                        ?>

                        <thead>
                            <tr>
                                <th class="pb-3">ID</th>
                                <th class="pb-3">Firstname</th>
                                <th class="pb-3">Lastname</th>
                                <th class="pb-3">Username</th>
                                <th class="pb-3">Department</th>
                                <th class="pb-3">Login Status</th>
                            </tr>
                        </thead>
                        <tbody>


                                <?php
                                    $num = 0;
                                    while ($row = mysqli_fetch_assoc($query)) {
                                        $num++;
                                ?>
                                    <tr class="border-b" data-department="<?php echo $row['department']; ?>">
                                        <td class="text-center py-2"><?php echo $num; ?></td>
                                        <td class="text-center py-2"><?php echo ucfirst($row['firstname']); ?></td>
                                        <td class="text-center py-2"><?php echo ucfirst($row['lastname']); ?></td>
                                        <td class="text-center py-2"><?php echo ucfirst($row['username']); ?></td>
                                        <td class="text-center py-2"><?php echo ucfirst($row['department']); ?></td>
                                        <td class="text-center py-2">
                                            <?php
                                            if ($row['mode'] === "online") {
                                                echo "<p style='color: green; font-weight: 700;'>Online</p>";
                                            } else if ($row['mode'] === "offline") {
                                                echo "<p style='color: black; font-weight: 700;'>Offline</p>";
                                            }
                                            ?>
                                        </td>
                                    </tr>

                                <?php }
                                } //if not equal to zero total users
                                    elseif($total_users == 0){
                                        echo "<p style='font-weight:700; color:black;'> No users found under <u>$dept</u>. </p>";
                                    }

                                }


                                }else{
                                    ?>
                                <thead>
                                    <tr>
                                        <th class="pb-3">ID</th>
                                        <th class="pb-3">Firstname</th>
                                        <th class="pb-3">Lastname</th>
                                        <th class="pb-3">Username</th>
                                        <th class="pb-3">Department</th>
                                        <th class="pb-3">Login Status</th>
                                    </tr>
                                </thead>
                                <tbody>



                                <?php
                                $num = 0;
                                while ($row = mysqli_fetch_assoc($res_query)) {
                                    $num++;
                            ?>
                                <tr class="border-b" data-department="<?php echo ucfirst($row['department']); ?>">
                                    <td class="text-center py-2"><?php echo $num; ?></td>
                                    <td class="text-center py-2"><?php echo ucfirst($row['firstname']); ?></td>
                                    <td class="text-center py-2"><?php echo ucfirst($row['lastname']); ?></td>
                                    <td class="text-center py-2"><?php echo ucfirst($row['username']); ?></td>
                                    <td class="text-center py-2"><?php echo ucfirst($row['department']); ?></td>
                                    <td class="text-center py-2">
                                        <?php
                                        if ($row['mode'] === "online") {
                                            echo "<p style='color: green; font-weight: 700;'>Online</p>";
                                        } else if ($row['mode'] === "offline") {
                                            echo "<p style='color: black; font-weight: 700;'>Offline</p>";
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php }
                            } ?>
                        </tbody>
                    </table>
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
    <script>
    // Function to filter users and items based on selected department
    function filterDataByDepartment() {
        const selectedDepartment = deptSelect.value;

        userTableRows.forEach(userRow => {
            const userDepartment = userRow.getAttribute('data-department');

            if (!selectedDepartment || selectedDepartment === userDepartment) {
                userRow.style.display = 'table-row';
            } else {
                userRow.style.display = 'none';
            }
        });

        itemTableRows.forEach(itemRow => {
            const itemDepartment = itemRow.getAttribute('data-department');

            if (!selectedDepartment || selectedDepartment === itemDepartment) {
                itemRow.style.display = 'table-row';
            } else {
                itemRow.style.display = 'none';
            }
        });
    }

    // Add event listener to the department select element
    deptSelect.addEventListener('change', filterDataByDepartment);

    // Initial filtering when the page loads
    filterDataByDepartment();
</script>
<script src="./script/jscript.js"></script>
<script src="./script/selectbydepartment.js" ></script>
<?php endif ?>
</body>
</html>