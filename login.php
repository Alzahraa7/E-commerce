<!-- backend -->
<?php
ob_start();
include "./layout.php";
 function pmessage($mess)
{
    echo "<div class='alert alert-primary' role='alert'>" . $mess. "</div>";
}

//admin login
if (isset($_POST['login'])){
    $adminName =filter_var($_POST['aName'],FILTER_SANITIZE_STRING);
    $adminPass = $_POST['aPass'];
    //select query
    $select = "SELECT * FROM `admins` WHERE adminName = '$adminName' AND adminPass = '$adminPass'";
    //run the query
    $run = mysqli_query($conn,$select);
    //check if the data is right
    $row = mysqli_fetch_assoc($run);
    if($row>0){
      $depart = $row['adminDepart'];
      $_SESSION['admin'] = $depart;
      header('location:listproduct.php');
      /*if($depart =1) $_SESSION['owner'] = $adminName;
      elseif($depart =2) $_SESSION['logistics'] = $adminName;
      elseif($depart =3) $_SESSION['HR'] = $adminName;*/
    }
    else{
       // echo pmessage("Sorry, You are NOT Admin") .mysqli_error($conn);
}
}
print_r($_SESSION);
ob_end_flush();
?>


<!-- Frontend -->
<html>
<head>
</head>
<body class="login-img3-body">
<form action="signup admin.php" >
  <button class="btn btn-primary btn-lg" style="float: right; margin:10px 10px;" type="submit" name="signup">Sign Up</button>
</form>
<form action="signup customer.php" >
  <button class="btn btn-primary btn-lg" style="float: right; margin:10px 10px;" type="submit" name="signupc">Customer</button>
</form>
<div class="container">

  <form class="login-form" method="POST" >
    <div class="login-wrap">
      <p class="login-img"><i class="icon_lock_alt"></i></p>
      <div class="input-group">
        <span class="input-group-addon"><i class="icon_profile"></i></span>
        <input type="text" class="form-control" placeholder="Admin name" name="aName" autofocus>
      </div>
      <div class="input-group">
        <span class="input-group-addon"><i class="icon_key_alt"></i></span>
        <input type="password" class="form-control" placeholder="Password" name="aPass">
      </div>
      <label class="checkbox">
              <input type="checkbox" value="remember-me"> Remember me
              <span class="pull-right"> <a href="#"> Forgot Password?</a></span>
          </label>
      <button class="btn btn-primary btn-lg btn-block" type="submit" name="login">Login</button>
    </div>
  </form>
  <div class="text-right">
    <div class="credits">
        <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version form: https://bootstrapmade.com/buy/?theme=NiceAdmin
        -->
      </div>
  </div>
</div>
</body></html>