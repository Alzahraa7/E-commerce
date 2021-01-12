<!-- backend -->
<?php
ob_start();
include "./side.php";
//routes secure
if ($_SESSION['admin']){}
else
header('location:login.php');
if ($_SESSION['admin']==1){}
else
header('location:side.php');
//select query to list 
$select = "SELECT * FROM `admins`";
//run the query
$run = mysqli_query($conn, $select);
// Edit admin
//to show data in the input field
$name ='';
$email='';
$pass='';
if (isset($_GET['Edit'])){
    $adminid = $_GET['Edit'];
    //select query
    $Select = "SELECT * FROM `admins` WHERE adminID = '$adminid'";
    //run query 
    $run = mysqli_query($conn , $Select);
    //to get the specific row 
    $row = mysqli_fetch_assoc($run);
    $name = $row ['adminName'];
    $pass = $row ['adminPass'];
    $email = $row ['adminEmail'];
    
}
//update 
if (isset($_POST['save'])){
    $adminname = $_POST['fullname'];
    $adminpass = $_POST['password'];
    $adminemail = $_POST['email'];
    //update query
    $update = "UPDATE `admins` SET adminName = '$adminname' , adminPass = '$adminpass' , adminEmail = '$adminemail' WHERE adminID = '$adminid'";
    //run the query
    $run = mysqli_query($conn , $update);
    if ($run){
        header('location:listadmins.php ');
    }
    else{echo '<script language="javascript">';
        echo 'alert("NO")';
        echo '</script>';
             }
    
}

//delete admin 
if (isset($_GET['Delete'])) {
    $adminid = $_GET['Delete'];
    //delete query 
    $delete = "DELETE FROM `admins` WHERE `adminID` = '$adminid'";
    //run query
    $run = mysqli_query($conn, $delete);
    if ($run) {
        echo "hello";
        header('location:listadmins.php');
    } else
        echo "not deleted" . mysqli_error($conn);
}

ob_end_flush();
?>

<!-- Frontend -->
<html>

<head>
</head>

<body>
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <div class="panel-body">
                            <div class="tab-content">
                                <table class="table table-striped table-advance table-hover">
                                    <tbody>
                                        <tr>
                                            <th><i class="icon_calendar"></i> ID</th>
                                            <th><i class="icon_profile"></i> Full Name</th>
                                            <th><i class="icon_mail_alt"></i> Email</th>
                                            <th><i class="icon_pin_alt"></i> Password</th>
                                            <th><i class="icon_cogs"></i> Action</th>
                                        </tr>
                                        <?php foreach ($run as $data) { ?>
                                            <tr>
                                                <td><?php echo $data['adminID']; ?></td>
                                                <td><?php echo $data['adminName'] ?></td>
                                                <td><?php echo $data['adminEmail'] ?></td>
                                                <td><?php echo $data['adminPass'] ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="listadmins.php?Edit=<?php echo $data['adminID'];?>" name="Edit" class="btn btn-primary "><i class="icon_plus_alt2"></i></a>
                                                        <a href="listadmins.php?Delete=<?php echo $data['adminID']; ?>" name="Delete" class="btn btn-danger"><i class="icon_close_alt2"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php  } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                    <div class="form" >
                        <div class="row">
                            <div class="col-lg-12">
                                <section class="panel">
                                    <div class="panel-body">
                                        <div class="form">
                                            <form class="form-validate form-horizontal " id="register_form" method="POST">
                                                <div class="form-group ">
                                                    <label for="fullname" class="control-label col-lg-2">Full name <span class="required">*</span></label>
                                                    <div class="col-lg-10">
                                                        <input class=" form-control" id="fullname1" name="fullname" value = "<?php echo $name?>" type="text" />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="password" class="control-label col-lg-2">Password <span class="required">*</span></label>
                                                    <div class="col-lg-10">
                                                        <input class="form-control " id="password1" name="password" value = "<?php echo $pass?>" type="password" />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="email" class="control-label col-lg-2">Email <span class="required">*</span></label>
                                                    <div class="col-lg-10">
                                                        <input class="form-control " id="email1" name="email" value = "<?php echo $email?>" type="email" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-offset-2 col-lg-10">
                                                        <button class="btn btn-primary" type="submit" name ="save">Save</button>
                                                        <button class="btn btn-default" type="button">Cancel</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
        </section>
        <script>
            $(function() {
                $('.mylink').click(function() {
                    $(this).hide();
                    $('.form').show();
                    return false;
                });
            });
        </script>
        </div>
    </section>
    </div>
    </div>
    </section>
    </section>
</body>

</html>