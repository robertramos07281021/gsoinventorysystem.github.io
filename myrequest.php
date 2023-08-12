<?php include('server.php');   


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="../GSOInvSys/css/style.css">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

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
        
    ?>

<!-- Navbar -->
    <nav class=" p-6 fixed h-full w-[20%]">
        <div class="drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)] h-full w-full rounded-xl bg-white p-8 text-center flex flex-col ">
            <a href="index.php" class="text-2xl font-bold"><span class="text-[red]">GSO</span> InvSystem</a>
            <hr class="mt-5 border border-black">
            <div class="text-start w-full mt-10 ">
                <ul>
                    <a aria-current="page" href="index_user.php">
                        <li class="mb-2 w-full hover:bg-red-300/20 p-3 rounded-md font-semibold flex gap-1 "><img src="./image/dashboard.png" class="rounded w-6 h-6">Dashboard</li>
                    </a>
                    <a href="myrequest.php">
                        <li class="mb-2 w-full p-3 bg-red-300/20 rounded-md font-bold flex gap-1 items-center transition ease-out duration-300"><img src="./image/users.png" class="bg-white p-1 rounded w-6 h-6">My Requests</li>
                    </a>

                    <a href="reportPageRequest.php">
                        <li class="mb-2 w-full p-3 hover:bg-red-300/20 rounded-md font-semibold flex gap-1 items-center transition ease-out duration-300"><img src="./image/report.png"  class="bg-white p-1 rounded w-6 h-6">Reports</li>   
                    </a>

                    <a href="update_account_user.php">
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

    <?php           $user = $_SESSION['user_id'];
                    $sql = "SELECT * FROM users WHERE user_id = '$user'";
                    $result = mysqli_query($db, $sql);
                    $row = mysqli_fetch_assoc($result);  
    ?>

    <article class=" col-span-4 py-6 pr-6 w-full h-full ">
        
        <div class="flex justify-between text-white">
            <div class="font-semibold text-2xl"><p>My Request</p></div>
            <p class="font-semibold"> Welcome  &nbsp; <span class="font-bold text-xl" ><?php echo ucfirst($row['firstname']) ." ".ucfirst ($row['lastname']);?></span></p>
        </div>

        
            


        <?php
 $u_dp = $row['department'];
 $name = ucfirst($row['firstname']). " ". ucfirst($row['lastname']);                      
 $num = 0;
 $ress = mysqli_query($db,"SELECT * FROM requests WHERE user_id='$user' ");
 $total_request = mysqli_num_rows($ress);

 $ress2 = mysqli_query($db,"SELECT * FROM requests WHERE requester='$name' AND r_status='pending'");
 $total_request2 = mysqli_num_rows($ress2);
?>

        <div class="grid grid-cols-5 mt-6 h-[96%] pb-6 gap-6">
            <div class="col-span-5 p-10 h-full bg-white rounded-xl drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)] mb-5">
            <table class="w-full">
                        <thead>
                            <tr>
                                
                                <th class="w-10 pb-3">ID</th>
                                <th class="w-40 pb-3">Item</th>
                                <th class="w-40 pb-3">Department</th>
                                <th class="w-40 pb-3">Property Code</th>
                                <th class="w-40 pb-3">Status</th>
                                
                                <th class="w-40 pb-3">Action</th>
                                
                             </tr>
                        </thead>

                        <tbody>
               
                        <?php
                       
                     while($rowr = mysqli_fetch_assoc($ress)) {
                     $num++;
                        ?>

                            <tr class="border-b">
                                <!-- rowsss from database will be displayed -->
                                
                                <td class="py-3 text-center"> <?php echo  $num; ?> </td>
                                <td class="py-3 text-center"> <?php echo  ucfirst($rowr['item_name']);?></td>
                                <td class="py-3 text-center"> <?php echo  $rowr['dep_name'] ?>  </td>
                                <td class="py-3 text-center"> <?php echo  $rowr['property_code'] ?>  </td>
                                <td class="py-3 text-center"> <?php echo  $rowr['r_status'] ?>  </td>
                                <td class="py-3 text-center"><a href="myrequest_view.php?id=<?php echo $rowr['r_id']; ?>" class="border-r pr-2 mr-2" style='color:blue; font-weight:700;'>View</a>
                              
                                <?php if($rowr['r_status']==="cancelled" || $rowr['r_status']==="declined"  ){ echo "";?>  <?php }
                                else{?>
                                    <a href="myrequest.php?id=<?php echo $rowr['r_id']; ?>" class="border-r pr-2 mr-2" style='color:red; font-weight:700;'>Cancel</a>
                                 
                                
                                 <?php  }  ?>
                                
                                </td>
                            </tr>




<?php


                     }


                     if(isset($_GET['id'])){
                        $idr = $_GET['id'];

                        mysqli_query($db,"UPDATE requests SET r_status='cancelled' WHERE r_id='$idr'");
                        ?>
                                                                <script>
                                                                    swal({title: "Request Cancelled!", text: "Your request has been cancelled.", type:"success"})
                                                                    .then(function(){ 
                                                                            location.href="myrequest.php";
                                                                        });
                                                                    
                                                            </script>
                                                        <?php 
                     }
                ?>
    </tbody>
    </table>

            </div>

            <!-- <div class="col-span-2  h-full bg-white rounded-xl drop-shadow-[0_0px_3px_rgba(0,0,0,0.5)] mb-5">
                

               


 
 
                     
            </div> -->
        </div>

                        

    </article>
    
    <div class="absolute top-0 left-0 h-full w-full bg-white/30 backdrop-blur-sm" id="logoutModal" >
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
 $(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;

    // or instead:
    // var maxDate = dtToday.toISOString().substr(0, 10);

   // alert(maxDate);
    $('#txtDate').attr('min', maxDate);
});
 
</script>
<script src="./script/jscript.js"> 

 </script>
<?php endif ?>
</body>
</html>