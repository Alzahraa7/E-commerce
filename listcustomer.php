<!-- backend -->
<?php
ob_start();
include "./side.php";
//routes secure
if ($_SESSION['admin']){}
else
header('location:login.php');
if ($_SESSION['admin']!=2 ){}
else
header('location:side.php');
//select query to list 
$select = "SELECT * FROM `customers`";
//run the query
$run = mysqli_query($conn, $select);
// Edit customer
//to show data in the input field
$name ='';
$email='';
$pass='';
$phone='';
$address='';
if (isset($_GET['Edit3'])){
    $customerid = $_GET['Edit3'];
    //select query
    $Select = "SELECT * FROM `customers` WHERE customerID = '$customerid'";
    //run query 
    $run = mysqli_query($conn , $Select);
    //to get the specific row 
    $row = mysqli_fetch_assoc($run);
    $name = $row ['customerName'];
    $pass = $row ['customerPass'];
    $email = $row ['customerEmail'];
    $phone = $row ['customerPhone'];
    $address = $row ['customerAddress'];
}
//update 
if (isset($_POST['save1'])){
    $customername = $_POST['fullname'];
    $customerpass = $_POST['password'];
    $customeremail = $_POST['email'];
    $customerphone = $_POST['phone'];
    $customeraddress = $_POST['address'];
    //update query
    $update = "UPDATE `customers` SET customerName = '$customername' , customerPass = '$customerpass' , customerEmail = '$customeremail' , customerPhone = '$customerphone', customerAddress = '$customeraddress' WHERE customerID = '$customerid'";
    //run the query
    $run = mysqli_query($conn , $update);
    if ($run){
        header('location:listcustomer.php ');
    }
    else{echo '<script language="javascript">';
        echo 'alert("NO")';
        echo '</script>';
             }
    
}

//delete admin 
if (isset($_GET['Delete3'])) {
    $customerid = $_GET['Delete3'];
    //delete query 
    $delete = "DELETE FROM `customers` WHERE `customerID` = '$customerid'";
    //run query
    $run = mysqli_query($conn, $delete);
    if ($run) {
        echo "hello";
        header('location:listcustomer.php');
    } else
    {echo '<script language="javascript">';
        echo 'alert("NO")';
        echo '</script>';
             }
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
                                            <th><i class="icon_mail_alt"></i> Phone</th>
                                            <th><i class="icon_pin_alt"></i> Address</th>
                                            <?php if ($_SESSION['admin'] != 3): ?>
                                            <th><i class="icon_cogs"></i> Action</th>
                                            <?php endif; ?>
                                        </tr>
                                        <?php foreach ($run as $data) { ?>
                                            <tr>
                                                <td><?php echo $data['customerID']; ?></td>
                                                <td><?php echo $data['customerName'] ?></td>
                                                <td><?php echo $data['customerEmail'] ?></td>
                                                <td><?php echo $data['customerPass'] ?></td>
                                                <td><?php echo $data['customerPhone'] ?></td>
                                                <td><?php echo $data['customerAddress'] ?></td>
                                                <?php if ($_SESSION['admin'] != 3): ?>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="listcustomer.php?Edit3=<?php echo $data['customerID'];?>" name="Edit3" class="btn btn-primary "><i class="icon_plus_alt2"></i></a>
                                                        <a href="listcustomer.php?Delete3=<?php echo $data['customerID']; ?>" name="Delete3" class="btn btn-danger"><i class="icon_close_alt2"></i></a>
                                                    </div>
                                                </td>
                                                <?php endif; ?>
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
                                <?php if ($_SESSION['admin'] != 3): ?>
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
                                                <div class="form-group ">
                                                    <label for="phone" class="control-label col-lg-2">Phone number <span class="required">*</span></label>
                                                    <div class="col-lg-10">
                                                        <input class="form-control " id="phone1" name="phone" value = "<?php echo $phone?>" type="text" />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="address" class="control-label col-lg-2"> Your Address <span class="required">*</span></label>
                                                    <div class="col-lg-10">
                                                        <input class="form-control " id="address1" name="address" value = "<?php echo $address?>" type="text" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-offset-2 col-lg-10">
                                                        <button class="btn btn-primary" type="submit" name ="save1">Save</button>
                                                        <button class="btn btn-default" type="button">Cancel</button>
                                                    </div>
                                                </div>
                                            </form>
                                            
                                        </div>
                                    </div>
                                    <?php endif; ?>
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