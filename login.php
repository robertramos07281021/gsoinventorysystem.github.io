<?php include('server.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <link rel="stylesheet" type="text/css" href="./css/style2.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>GSO Invsys Sample</title>
</head>

<body class="h-screen bg-red-500/90">

    <?php
        if(isset($_SESSION['register']) && $_SESSION['register'] != ''){
    ?> 
    <script>
        swal("Success!", "You have created an account.", "success");
    </script>
    <?php
    unset($_SESSION['register']);
        }
    ?>  

    <div class="w-full p-12 h-full ">    
        <div class="w-full grid grid-cols-3 loginRight h-full rounded-[20px] drop-shadow-[0_0px_10px_rgba(0,0,0,0.5)]">
            <div class="w-full h-full p-9 ">
                <div class="border w-full h-full bg-white flex justify-center items-center rounded-lg">
                    <div class=" w-64 ">
                        <div class="text-center flex justify-center">
                            <img src="./image/icons8-human-64.png" height="10px" width="50px">
                            <h2 class="text-2xl pl-1 flex items-end ">Log in</h2>
                        </div>
                        <form method="POST" action="login.php" class="w-full">

                            <div class=" mb-4 mt-16 relative w-full flex flex-col">
                                <input type="text" name="log_username"  class="w-full relative z-10 border-0 border-b-2 border-black bg-transparent text-black outline-none px-2 peer focus:border-2 transform duration-100 focus:rounded-md" placeholder=" " >

                                <label class="peer-focus:font-medium absolute text-lg duration-500 transform -translate-y-8 scale-75 -top-[1px] left-1 origin-[0] peer-focus:left-0 peer-focus:text-black text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1 peer-placeholder-shown:text-gray-400 peer-focus:scale-75 peer-focus:-translate-y-8 peer-placeholder-shown:text-lg">Username</label>
                            </div>


                            <div class=" mb-4 mt-9 relative w-full flex flex-col">     
                                <input type="password" name="log_password" placeholder=" " class="w-full relative z-10 border-0 border-b-2 border-black  bg-transparent text-black outline-none px-2 peer focus:border-2 transform duration-100 focus:rounded-md">

                                <label class="peer-focus:font-medium absolute text-lg duration-500 transform -translate-y-8 scale-75 -top-[1px] left-1 origin-[0] peer-focus:left-0 peer-focus:text-black text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1 peer-placeholder-shown:text-gray-400 peer-focus:scale-75 peer-focus:-translate-y-8 peer-placeholder-shown:text-lg">Password</label>
                            </div>

                            <div class="mt-8">
                                <button type="submit" name="login" class="font-bold text-white border px-4 py-1 rounded-lg w-full flex justify-center items-center transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 hover:bg-indigo-500 duration-300" id="btnLog">
                                    <img src="./image/icons8-login-64.png" class="w-6 h-6">
                                    Login
                            </button>
                            </div>

                        </form>
                    </div>   
                </div>
            </div>
        </div>
    </div>   

<?php
    //login page

if(isset($_POST['login'])){
    $log_user = mysqli_real_escape_string($db, $_POST['log_username']);
    $log_password = mysqli_real_escape_string($db, $_POST['log_password']);
    $pass = md5($log_password);

    $sql = "SELECT * FROM users WHERE username = '$log_user' AND password ='$pass'";

    $result = mysqli_query($db, $sql);
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    $stat = "active";

   
    $on = "online";
    if( $count === 1 && $row['status']=== $stat && $row['role'] === "admin"){
        $user_id = $row['user_id'];
        if($row['username'] === $log_user && $row['password'] === $pass){
        $_SESSION['username'] = $row['username'];
        $_SESSION['firstname'] = $row['firstname'];
        $_SESSION['lastname'] = $row['lastname'];
        $_SESSION['user_id'] = $row['user_id'];

        $mquery= "UPDATE users SET mode='$on' WHERE user_id='$user_id' ";
        mysqli_query($db, $mquery);  //update mode as online

        header('location: index.php');

        
        

        
    }elseif(empty($log_user)||empty($log_password) || $row['username'] != $log_user && $row['password'] != $pass ){
        ?>
            <script>
      swal({title: "Sorry", text: "Invalid credentials!", type:"error", icon: "error"});
         </script>
        <?php
    } 


 

}else if( $count === 1 && $row['status']=== $stat && $row['role'] === "user"){
    $user_id = $row['user_id'];

    if($row['username'] === $log_user && $row['password'] === $pass){

    $_SESSION['username'] = $row['username'];
    $_SESSION['firstname'] = $row['firstname'];
    $_SESSION['lastname'] = $row['lastname'];
    $_SESSION['user_id'] = $row['user_id'];

    $mquery= "UPDATE users SET mode='$on' WHERE user_id='$user_id' ";
    mysqli_query($db, $mquery);  //update mode as online

    header('location: index_user.php');

    
    }elseif(empty($log_user)||empty($log_password) || $row['username'] != $log_user && $row['password'] != $pass ){
        ?>
            <script>
      swal({title: "Sorry", text: "Invalid credentials!", type:"error", icon: "error"});
         </script>
        <?php
    }

    
} elseif($row['username'] != $log_user && $row['password'] != $pass){
    ?>
<script>
      swal({title: "Sorry", text: "Invalid credentials!", type:"error", icon: "error"});
         </script>
    <?php
}

}
?>


</body>
</html>