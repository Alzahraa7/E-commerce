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
$select = "SELECT orderQuentity , orderID , customers.customerName , products.proName FROM customers JOIN orders ON customers.customerID = orders.customerid INNER JOIN products ON products.proID=productid";
//run the query
$run = mysqli_query($conn, $select);
// Edit admin
//to show data in the input field
$name ='';
if (isset($_GET['Edit4'])){
    $orderid = $_GET['Edit4'];
    //select query
    $Select = "SELECT orderQuentity , orderID , customers.customerName , products.proName FROM customers JOIN orders ON orderID='$orderid' AND customers.customerID = orders.customerid INNER JOIN products ON products.proID=productid";
    //run query 
    $run = mysqli_query($conn , $Select);
    //to get the specific row 
    $row = mysqli_fetch_assoc($run);
    $name = $row ['orderQuentity'];
}
//update 
if (isset($_POST['uporder'])){
    $quentity = $_POST['oquentity'];
    //update query
    $update = "UPDATE `orders` SET orderQuentity = '$quentity' WHERE orderID = '$orderid'";
    //run the query
    $run = mysqli_query($conn , $update);
    if ($run){
        header('location:listorder.php ');
    }
    else{echo '<script language="javascript">';
        echo 'alert("NO")';
        echo '</script>';
             }
    
}

//delete admin 
if (isset($_GET['Delete4'])) {
    $order = $_GET['Delete4'];
    //delete query 
    $delete = "DELETE FROM `orders` WHERE `orderID` = '$order'";
    //run query
    $run = mysqli_query($conn, $delete);
    if ($run) {
        echo "hello";
        header('location:listorder.php');
    } else
        echo "not deleted" . mysqli_error($conn);
}

ob_end_flush();
?>

<!-- Frontend -->
<html>

<head></head>
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
                                            <th><i class="icon_profile"></i> Customer Name</th>
                                            <th><i class="icon_mail_alt"></i> Product Name</th>
                                            <th><i class="icon_mail_alt"></i> Product’s Quentity</th>
                                            <?php if ($_SESSION['admin'] != 3): ?>
                                            <th><i class="icon_cogs"></i> Action</th>
                                            <?php endif;?>
                                        </tr>
                                        <?php foreach ($run as $data) { ?>
                                            <tr>
                                                <td><?php echo $data['orderID']; ?></td>
                                                <td><?php echo $data['customerName'] ?></td>
                                                <td><?php echo $data['proName'] ?></td>
                                                <td><?php echo $data['orderQuentity'] ?></td>
                                                <?php if ($_SESSION['admin'] != 3): ?>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="listorder.php?Edit4=<?php echo $data['orderID'];?>" name="Edit4" class="btn btn-primary "><i class="icon_plus_alt2"></i></a>
                                                        <a href="listorder.php?Delete4=<?php echo $data['orderID']; ?>" name="Delete4" class="btn btn-danger"><i class="icon_close_alt2"></i></a>
                                                    </div>
                                                </td>
                                                <?php endif;?>
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
                                        <form class="form-horizontal " method="POST">
                                <div class="form-group">
                                    <label class="control-label col-lg-2" style="font-family: cursive; font-size:large; color: #79810a" for="inputSuccess">Order Quentity</label>
                                    <div class="col-lg-10">
                                        <input class="form-control input-lg m-bot15" name ="oquentity" value="<?php echo $name ?>" type="number">
                                    </div>
                                    <div class = "col-lg-5"></div>
                                    <div class = "col-lg-7">
                                    <button class="btn btn-success" name = "uporder" type="submit" title="Bootstrap 3 themes generator">Update my order</a>
                                    </div>
                                </div>
                            </form>
                                        </div>
                                    </div>
                                    <?php endif;?>
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