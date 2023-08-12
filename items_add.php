<?php
include('server.php'); 
include('serverAdd.php');   
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
        .newItemsButton{
            box-shadow: 2px 2px 0px 0px #000000;
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

                    <a href="report.php">
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
                <p class="font-semibold text-2xl"><a href="items_page.php">Items</a> / <span class="text-gray-200 ">New Item</span></p>
                <p class="font-semibold"> Welcome  Admin <span class="font-bold text-xl" ><?php echo ucfirst($row['firstname']) ." ".ucfirst ($row  ['lastname']);?></span></p>
            </div>
            <div class="w-full h-[89.5%] mt-5 ">
                <div class="w-full h-full gap-6  bg-white rounded-xl flex justify-center drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)]">
                    <div class=" w-1/2 h-full">
                        <h2 class="w-full  text-center text-3xl font-bold mb-10 pt-10">New Item</h2>
                        <?php
                        if (!empty($errorMessage)) {
                            echo "
                            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            <strong>$errorMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>
                            ";
                        }
                        ?>
                        <form method="post" class="w-full grid content-between  h-[80.5%]">
                            <div>
                            <div class=" mb-3">
                                <label for="item_name"class="text-xl font-semibold">Item Name:</label>
                                <div class="col-sm-6">
                                    <input type="text" class="w-full border-2 border-gray-200 rounded p-1 " name="item_name" id="item_name" value="<?php echo $item_name; ?>">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="dep_names" class="text-xl font-semibold">Department:</label>
                                <div class="col-sm-6">
                                    <select class="w-full border-2 border-gray-200 rounded p-1" id="dep_names" name="dep_names">
                                        <?php foreach ($dep_names as $dep_name => $dep_names) { // Loop through dep_names array
                                            echo "<option value='" . htmlspecialchars($dep_name) . "'>" . htmlspecialchars($dep_names) . "</option>";
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="property_code" class="text-xl font-semibold">Property Code:</label>
                                <div class="col-sm-6">
                                    <input type="text" class="w-full border-2 border-gray-200 rounded p-1" name="property_code" id="property_code" value="<?php echo $property_code; ?>">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="text-xl font-semibold">Quantity:</label>
                                <div class="col-sm-6">
                                    <input type="number" class="w-full border-2 border-gray-200 rounded p-1" name="quantity" id="quantity" value="<?php echo $quantity; ?>">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="end_user" class="text-xl font-semibold">User:</label>
                                <div class="col-sm-6">
                                    <input type="text" class="w-full border-2 border-gray-200 rounded p-1" name="end_user" id="end_user" value="<?php echo $end_user; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="description" class="text-xl font-semibold">Description</label>
                                <div class="col-sm-6">
                                    <input type="text" class="w-full border-2 border-gray-200 rounded p-1" name="description" id="description" value="<?php echo $description; ?>">
                                </div>
                            </div>
                            </div>
                            <?php
                            if (!empty($successMessage)) {
                                echo "
                                <div class='row mb-3'>
                                        <div class='offset-sm-3 col-sm-6'>
                                            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                            <strong>$successMessage</strong>
                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>
                                        </div>
                                </div>
                                ";
                            }
                            ?>

                            <div class="flex gap-10 justify-center pb-5">
                                <div class="">
                                    <button type="submit" class="bg-green-500 py-1 w-32 text-white border border-green-500 font-semibold newItemsButton rounded transition ease-out duration-300 hover:text-green-500 hover:bg-white">Add Item</button>
                                </div>
                                <div class="">
                                    <a  href="items_page.php" role="button"><div class="bg-red-500 border border-red-500 text-white text-center font-semibold py-1 w-32 newItemsButton rounded transition ease-out duration-300 hover:text-red-500 hover:bg-white">Cancel</div></a>
                                </div>
                            </div>
                        </form>
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