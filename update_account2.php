<?php include('server.php'); ?>
<?php include('errors.php');  ?> 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
 
<style>
    .goBack{
        text-decoration:none; 
        color: black;
    }

    .goBack:hover{
        color: blue;
    }
</style>


    <title>GSO Invsys Sample</title>
</head>
<body>
    <div class="header">
        <h2>Update Your Account</h2>
    </div>

    

    </div>
 <?php
        //connect to db and display account details
        $user = $_SESSION['user_id'];
        $sql = "SELECT * FROM users WHERE user_id = '$user'";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
?>
            <form method="POST">

          <label> Firstname: </label>  <input type="text" name="up_firstname" placeholder="Firstname" 
            value="<?php echo $row['firstname'] ?>" required> 

            <br>

            <label> Lastname: </label>  <input type="text" name="up_lastname" placeholder="Lastname" 
            value="<?php echo $row['lastname'] ?>" required> 

            <br>

            <label> Email: </label>  <input type="email" name="up_email" placeholder="Email" 
            value="<?php echo $row['email'] ?>" required> 

            <br>

            <label> Phone: </label>  <input type="number" name="up_phone" placeholder="Phone number" 
            value="<?php echo $row['phone_num'] ?>" required> 

            <br>

            <label> Address: </label>  <input type="text" name="up_address" placeholder="Address" 
            value="<?php echo $row['u_address'] ?>" required> 

            <br>

            <label> Username: </label>  <input type="text" name="up_username" placeholder="Username" 
            value="<?php echo $row['username'] ?>" required> 
    <br> <br>
            <!-- <br> <br><p> Enter your current password to save changes. </p> <br> -->

            <input type="password" name="up_pass1" placeholder="Password" id="pass1" required>
                <!-- An element to toggle between password visibility -->
                    <input type="checkbox" onclick="myFunction1()">Show Password 
                    <br><br>

                    <input type="password" name="up_pass2" placeholder="Confirm Password" id="pass2"  required> 
                    <!-- An element to toggle between password visibility -->
                    <input type="checkbox" onclick="myFunction2()">Show Password 
                    <br><br>

                    <button type="submit" name="post_update"> Save Changes</button>
                    <br><br>

            </form>


     

            <p><a href="index.php"  class="goBack">Go to Main page</a></p>
        
<?php
$errors = array();
 

            //update user Account
            if(isset($_POST['post_update'])){
                    
                $u_id = $_SESSION['user_id'];
                $firstname = mysqli_real_escape_string($db, $_POST['up_firstname']);
                $lastname = mysqli_real_escape_string($db, $_POST['up_lastname']);
                $email = mysqli_real_escape_string($db, $_POST['up_email']);
                $address = mysqli_real_escape_string($db, $_POST['up_address']);
                $phone = mysqli_real_escape_string($db, $_POST['up_phone']);
                $username = mysqli_real_escape_string($db, $_POST['up_username']);
                $pass1 = mysqli_real_escape_string($db, $_POST['up_pass1']);
                $pass2 = mysqli_real_escape_string($db, $_POST['up_pass2']);


                if(strlen(trim($firstname))==0 || empty($firstname)){
                    array_push($errors, "Please enter your firstname.");
                    echo "<div class='error' style='width: 90%;
                    margin: 0px auto;
                    padding: 10px;
                    border: 1px solid #a94442;
                    color: #a94442;
                    background: #f2dede;
                    border-radius: 5px;
                    text-align: left;'>Your firstname must not be empty!. </div>";
                }

                if(strlen(trim($lastname))==0 || empty($lastname)){
                    array_push($errors, "Please enter your lastname.");
                    echo "<div class='error' style='width: 90%;
                    margin: 0px auto;
                    padding: 10px;
                    border: 1px solid #a94442;
                    color: #a94442;
                    background: #f2dede;
                    border-radius: 5px;
                    text-align: left;'>Your lastname must not be empty!. </div>";
                }

                
                if(strlen(trim($email))==0 || empty($email)){
                    array_push($errors, "Please enter your email.");
                    echo "<div class='error' style='width: 90%;
                    margin: 0px auto;
                    padding: 10px;
                    border: 1px solid #a94442;
                    color: #a94442;
                    background: #f2dede;
                    border-radius: 5px;
                    text-align: left;'>Your email must not be empty!. </div>";
                }


                if(strlen(trim($phone))==0 || empty($phone)){
                    array_push($errors, "Please enter your phone.");
                    echo "<div class='error' style='width: 90%;
                    margin: 0px auto;
                    padding: 10px;
                    border: 1px solid #a94442;
                    color: #a94442;
                    background: #f2dede;
                    border-radius: 5px;
                    text-align: left;'>Your phone must not be empty!. </div>";
                }



                if(strlen(trim($address))==0 || empty($address)){
                    array_push($errors, "Please enter your address.");
                    echo "<div class='error' style='width: 90%;
                    margin: 0px auto;
                    padding: 10px;
                    border: 1px solid #a94442;
                    color: #a94442;
                    background: #f2dede;
                    border-radius: 5px;
                    text-align: left;'>Your address must not be empty!. </div>";
                }



                if(strlen(trim($username))==0 || empty($username)){
                    array_push($errors, "Please enter your username.");
                    echo "<div class='error' style='width: 90%;
                    margin: 0px auto;
                    padding: 10px;
                    border: 1px solid #a94442;
                    color: #a94442;
                    background: #f2dede;
                    border-radius: 5px;
                    text-align: left;'>Your username must not be empty!. </div>";
                }



                if(strlen(trim($pass1))==0 || empty($pass1)){
                    array_push($errors, "Please enter your password.");
                    echo "<div class='error' style='width: 90%;
                    margin: 0px auto;
                    padding: 10px;
                    border: 1px solid #a94442;
                    color: #a94442;
                    background: #f2dede;
                    border-radius: 5px;
                    text-align: left;'>Your password must not be empty!. </div>";
                }


                if(strlen($pass1) < 8){
                    array_push($errors, "Password must be atleast 8 characters long.");
                    echo "<div class='error' style='width: 90%;
                    margin: 0px auto;
                    padding: 10px;
                    border: 1px solid #a94442;
                    color: #a94442;
                    background: #f2dede;
                    border-radius: 5px;
                    text-align: left;'>Password must be atleast 8 characters long.. </div>";
                }

                if($pass1 !== $pass2){
                    array_push($errors, "Password does not match.");
                    echo "<div class='error' style='width: 90%;
                    margin: 0px auto;
                    padding: 10px;
                    border: 1px solid #a94442;
                    color: #a94442;
                    background: #f2dede;
                    border-radius: 5px;
                    text-align: left;'>Password does not match. Please try again. </div>";
                }


                $password = md5($pass1);
                if(count($errors) === 0){

                    $sql= "UPDATE users SET firstname='$firstname',lastname='$lastname',
                    email='$email', phone_num='$phone', u_address='$address', username='$username', password='$password' WHERE user_id='$u_id' ";
                    
                    mysqli_query($db, $sql);  //update to database
                        ?>
                        <script>
                                swal({title: "Success!", text: "Your Account has been updated.", type: 
                                        "success"}).then(function(){ 
                                            location.href="update_account2.php";
                                        }
                                        );
                        </script>

                        <?php

                        

                }


            }



?>
    




<!--Bootstrap script-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>


<!-- Script for hidden textbox -->

<script>
        //Show password

        function myFunction1() {
            var x = document.getElementById("pass1");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
            }

            function myFunction2() {
            var x = document.getElementById("pass2");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
            }
</script>
</body>
</html>