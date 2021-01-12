<!-- backend -->
<?php
ob_start();
include "./layout.php";
function pmessage($mess)
{
    echo "<div class='alert alert-primary' role='alert'>" . $mess. "</div>";
}
//admin signup
if (isset($_POST['signupc'])){
    $customerName = $_POST['CName'];
    $customerEmail = $_POST['CEmail'];
    $customerPhone = $_POST['CPhone'];
    $customerAddress = $_POST['CAddress'];
    $customerPass = $_POST['CPass'];
    //insert query
    $insert = "INSERT INTO `customers` VALUES (NULL,'$customerName','$customerPass','$customerEmail','$customerPhone','$customerAddress')";
    //run the query
    $run = mysqli_query($conn,$insert);
    if($run){
        header('location:login user.php');
    }
    else{
        echo pmessage("Not inserted") .mysqli_error($conn);
}
}
ob_end_flush();
?>


<!-- Frontend -->
<html>
<head>
</head>
<body class="login-img3-body">

<div class="container">

  <form class="login-form" method="POST" >
    <div class="login-wrap">
      <p class="login-img"><i class="icon_lock_alt"></i></p>
      <div class="input-group">
        <span class="input-group-addon"><i class="icon_profile"></i></span>
        <input required type="text" class="form-control" placeholder="Your name" name="CName" autofocus>
      </div>
      <div class="input-group">
        <span class="input-group-addon"><i class="icon_profile"></i></span>
        <input required type="email" class="form-control" placeholder="Your Email" name="CEmail" autofocus>
      </div>
      <div class="input-group">
        <span class="input-group-addon"><i class="icon_profile"></i></span>
        <input required type="text" class="form-control" placeholder="Your phone number" name="CPhone" autofocus>
      </div>
      <div class="input-group">
        <span class="input-group-addon"><i class="icon_profile"></i></span>
        <input type="text" class="form-control" placeholder="Your Address" name="CAddress" autofocus>
      </div>
      <div class="input-group">
        <span class="input-group-addon"><i class="icon_key_alt"></i></span>
        <input required type="password" class="form-control" placeholder="Password" name="CPass">
      </div>
      <label class="checkbox">
              <input type="checkbox" value="remember-me"> Remember me
              <span class="pull-right"> <a href="#"> Forgot Password?</a></span>
          </label>
      <button class="btn btn-primary btn-lg btn-block" type="submit" name="signupc">Sign Up</button>
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