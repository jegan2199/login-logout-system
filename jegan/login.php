<?php
require('connection/db.php');
session_start();
$error="true";

// If form submitted, insert values into the database.
if (isset($_POST['login'])){

        // removes backslashes
 $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
 $username = mysqli_real_escape_string($con,$username);
 $password = stripslashes($_REQUEST['password']);
 $password = mysqli_real_escape_string($con,$password);
 //Checking is user existing in the database or not
 $query = "SELECT * FROM `users` WHERE username='$username'and password='".md5($password)."'";
 $result = mysqli_query($con,$query) or die(mysql_error());
 $rows = mysqli_num_rows($result);
        if($rows==1){
     $_SESSION['username'] = $username;
            // Redirect user to index.php
     header("Location: index.php");
         }else{
          $error="false";

 }
}

if (isset($_POST['register'])){
 // removes backslashes
 $username = stripslashes($_REQUEST['uname']);
        //escapes special characters in a string
 $username = mysqli_real_escape_string($con,$username); 
 $email = stripslashes($_REQUEST['uemail']);
 $email = mysqli_real_escape_string($con,$email);
 $password = stripslashes($_REQUEST['upassword']);
 $password = mysqli_real_escape_string($con,$password);
 $account_no=mysqli_real_escape_string($con,$_REQUEST['account_no']); 

 $trn_date = date("Y-m-d H:i:s");
        $query = "INSERT into `users` (username, password, email, trn_date,account_no)
VALUES ('$username', '".md5($password)."', '$email', '$trn_date','$account_no')";
        $result = mysqli_query($con,$query);
        if($result){
            echo "<div class='form'>
<h3>You are registered successfully.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
        }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" href="css/login.css">
</head>
<body>
  <div class="formset">
    <div class="common">
      <div class="bow">
        <div id="btn"></div>
        <button type="button" class="toggle" onclick="login()">Log-in</button> 
        <button type="button" class="toggle" onclick="register()">Register</button>
      </div>
      <form id="login" method="POST" class="form">
        <input type="Username" name="username" class="inputfield" placeholder="Enter Username" required>
        <!-- <input type="email" class="inputfield" placeholder="Enter Email" required> -->
        <input type="password" name="password" class="inputfield" placeholder="Enter Password" required>
        
         <input type="submit" name="login" class="btn-btn" value="Log-In">
         <div style="float:left;width:100%;color:#fff"><?php if($error=="false"){echo "Username/password is incorrect.";}?></div>
      </form> 
     <form id="register" method="POST" class="form">
        <input type="Username" name="uname" class="inputfield1" placeholder="Enter Username" required>
        <input type="number"  name="account_no" class="inputfield1" placeholder="Enter accountno"  required>
        <input type="email"  name="uemail" class="inputfield1" placeholder="Enter Email" required>
        <input type="password"  name="upassword" class="inputfield1" placeholder="Enter Password" required>
         <input type="submit" name="register" class="btn-btn" value="Sign Up">
      </form>
    </div>
  </div>
  <script>
    var x=document.getElementById("login")
    var y=document.getElementById("register")
    var z=document.getElementById("btn")
    var submit=document.getElementById("btn-btn")
    var username=document.getElementByclassName("inputfield")

    function register(){
     x.style.left="-400px";
     y.style.left="50px";
     z.style.left="110px";
   }
    function login(){
     x.style.left="50px";
     y.style.left="400px";
     z.style.left="0px";
   }
   function submission(){
    window.open("home.php");
}
  </script>
</body>
</html>