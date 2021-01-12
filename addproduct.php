<!-- backend -->
<?php
ob_start();
include "./side.php";

//routes secure
if ($_SESSION['admin']){}
else
header('location:login.php');
if ($_SESSION['admin']==2 || $_SESSION['admin']==4 || $_SESSION['admin']==1){}
else
header('location:side.php');

if (isset($_POST['addpro'])) {
    $productname = filter_var($_POST['proname'] , FILTER_SANITIZE_STRING) ;
    //creating array for errors 
    $formErrors = '';
    //positive number
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (strlen($productname) < 4 || preg_match('a-z',$productname)) {
            $formErrors = "You cant type product less than 4 ";
        }
    }
    $productprice =filter_var($_POST['proprice'] , FILTER_SANITIZE_STRING) ; 
    // image
    $imagetype = $_FILES['proimage']['type'];
    $imagename = $_FILES['proimage']['name'];
    $temporaryname = $_FILES['proimage']['tmp_name'];
    $location = './upload/';
    if (move_uploaded_file($temporaryname, $location . $imagename)) {
        echo "image uploaded";
    } else
        echo "failed";
    $adminname = $_POST['adname'];
    $sectionname = $_POST['secname'];
    $Select = "SELECT * FROM admins,sections WHERE adminID=$adminname AND sectionID=$sectionname";
    if ($Select) {
        //insert query 
        $insert = "INSERT INTO `products` VALUES (NULL , '$productname' , '$productprice' , '$imagename' , '$adminname' , '$sectionname')";
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
                            <form class="form-horizontal " action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="control-label col-lg-2" style="font-family: cursive; font-size:large; color: #79810a" for="inputSuccess">Product Name</label>
                                    <div class="col-lg-10">
                                        <input class="form-control input-lg m-bot15" name="proname" type="text">
                                    </div>
                                    <?php
                                    if (isset($formErrors)) { ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?php echo $formErrors; ?>
                                        </div>
                                    <?php } ?>
                                    <label class="control-label col-lg-2" style="font-family: cursive; font-size:large; color: #79810a" for="inputSuccess">Product Price</label>
                                    <div class="col-lg-10">
                                        <input class="form-control input-lg m-bot15" name="proprice" type="number" min="1">
                                    </div>
                                    <label for="exampleInputFile" class="control-label col-lg-2" style="font-family: cursive; font-size:large; color: #79810a">Product image</label>
                                    <div class="col-lg-10">
                                        <input class="form-control input-lg m-bot15" name="proimage" type="file" accept="image/*" id="exampleInputFile3">
                                    </div>
                                    <label class="control-label col-lg-2" style="font-family: cursive; font-size:large; color: #79810a" for="inputSuccess">Pick your name</label>
                                    <div class="col-lg-10">
                                        <select name="adname" class="form-control input-lg m-bot15">
                                            <?php
                                            //select query
                                            $select = "SELECT * FROM `admins`";
                                            //run the query
                                            $run = mysqli_query($conn, $select);
                                            foreach ($run as $data) {
                                            ?>
                                                <option value="<?php echo $data['adminID'] ?>">
                                                    <?php echo $data['adminName'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <label class="control-label col-lg-2" style="font-family: cursive; font-size:large; color: #79810a" for="inputSuccess">Pick Section</label>
                                    <div class="col-lg-10">
                                        <select name="secname" class="form-control input-lg m-bot15">
                                            <?php
                                            //select query
                                            $select = "SELECT * FROM `sections`";
                                            //run the query
                                            $run = mysqli_query($conn, $select);
                                            foreach ($run as $data) {
                                            ?>
                                                <option value="<?php echo $data['sectionID'] ?>">
                                                    <?php echo $data['sectionName'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-5"></div>
                                    <div class="col-lg-7">
                                        <button class="btn btn-success" name="addpro" type="submit" title="Bootstrap 3 themes generator">Add Product</a>
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