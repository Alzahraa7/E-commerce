<!-- backend -->
<?php
ob_start();
include "./side.php";

//routes secure
if ($_SESSION['admin']){}
else
header('location:login.php');

if (isset($_GET['take'])) {
    $productid = $_GET['take'];
}
if (isset($_POST['addorder'])) {
    //select query
    $Select = "SELECT products.proPrice FROM products WHERE proID = '$productid'";
    //run query 
    $run = mysqli_query($conn, $Select);
    //to get the specific row 
    $row = mysqli_fetch_assoc($run);
    $price = $row['proPrice'];
    $productquentity = $_POST['proquentity'];
    /*$sum = '(' . $productquentity . '*' . $price . ')';
    $result = eval("return " . $sum . ";");
    echo '<script language="javascript">';
    echo 'alert(' . $result . ')';
    echo '</script>';*/
    $customername = $_POST['cname'];
    $Select = "SELECT * FROM customers,products WHERE customerID=$customername AND proID=$productid";
    if ($Select) {
        //insert query 
        $insert = "INSERT INTO `orders` VALUES (NULL , '$customername' , '$productid' , '$productquentity')";
    } else
        echo "Inserted failed";
    //run query
    $run = mysqli_query($conn, $insert);
    //check
    if ($run) {
        header('location: listproduct.php');
    } else {
        $msg = mysqli_error($conn);
        echo "<h1 style: text-align:center>NO.$msg</h1>";
    }
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
                            
                            <form class="form-horizontal " method="POST">
                                <div class="form-group">
                                    <label class="control-label col-lg-2" style="font-family: cursive; font-size:large; color: #79810a" for="inputSuccess">Product Quentity</label>
                                    <div class="col-lg-10">
                                        <input class="form-control input-lg m-bot15" name="proquentity" type="number" min="1">
                                    </div>
                                    <label class="control-label col-lg-2" style="font-family: cursive; font-size:large; color: #79810a" for="inputSuccess">Pick your name</label>
                                    <div class="col-lg-10">
                                        <select name="cname" class="form-control input-lg m-bot15">
                                            <?php
                                            //select query
                                            $select = "SELECT * FROM `customers`";
                                            //run the query
                                            $run = mysqli_query($conn, $select);
                                            foreach ($run as $data) {
                                            ?>
                                                <option value="<?php echo $data['customerID'] ?>">
                                                    <?php echo $data['customerName'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-5"></div>
                                    <div class="col-lg-7">
                                        <button class="btn btn-success" name="addorder" type="submit" title="Bootstrap 3 themes generator">Order</a>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </section>
                </div>
            </div>
        </section>
    </section>
</body>

</html>