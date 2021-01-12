<!-- backend -->
<?php
ob_start();
include "./layout.php";
function pmessage($mess)
{
  echo "<div class='alert alert-primary' role='alert'>" . $mess . "</div>";
}
//admin signup
if (isset($_POST['signup'])) {
  if (filter_has_var(INPUT_POST, 'AEmail')) {
    $adminEmail = filter_var($_POST['AEmail'], FILTER_SANITIZE_EMAIL);
    if (filter_input(INPUT_POST, 'AEmail', FILTER_VALIDATE_EMAIL)) {
      echo "Email is valid";
    } else
      echo "Not Valid";
  }
  $adminName = filter_var($_POST['AName'], FILTER_SANITIZE_STRING);

  $adminPass = $_POST['APass'];
  $admindepart = $_POST['depid'];
  //insert query
  $insert = "INSERT INTO `admins` VALUES (NULL,'$adminName','$adminPass','$adminEmail','$admindepart')";
  //run the query
  $run = mysqli_query($conn, $insert);
  if ($run) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (strlen($adminName) < 3 || preg_match('a-z', $adminName)) {
        $formErrors = "You cant type product less than 3 ";
      }
    }
    header('location:login.php');
  } else {
    echo pmessage("Not inserted") . mysqli_error($conn);
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

    <form class="login-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
      <div class="login-wrap">
        <p class="login-img"><i class="icon_lock_alt"></i></p>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_profile"></i></span>
          <input required type="text" class="form-control" placeholder="Admin name" name="AName" autofocus>
        </div>
        <?php
        if (isset($formErrors)) { ?>
          <div>
            <?php echo $formErrors; ?>
          </div>
        <?php } ?>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_profile"></i></span>
          <input required type="email" class="form-control" placeholder="Admin Email" name="AEmail" autofocus>
        </div>
        <div class="input-group">
          <select name="depid" class="form-control input-lg m-bot15">
            <?php
            //select query
            $select = "SELECT * FROM `department`";
            //run the query
            $run = mysqli_query($conn, $select);
            foreach ($run as $data) {
            ?>
              <option value="<?php echo $data['id'] ?>">
                <?php echo $data['name'] ?>
              </option>
            <?php } ?>
          </select>
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_key_alt"></i></span>
          <input required type="password" class="form-control" placeholder="Password" name="APass">
        </div>
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
          <span class="pull-right"> <a href="#"> Forgot Password?</a></span>
        </label>
        <button class="btn btn-primary btn-lg btn-block" type="submit" name="signup">Sign Up</button>
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
</body>

</html>