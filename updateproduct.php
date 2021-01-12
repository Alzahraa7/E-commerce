<!-- backend -->
<?php
ob_start();
include "./side.php";
//routes secure
if ($_SESSION['admin']){}
else
header('location:login.php');
if ($_SESSION['admin']!=5 || $_SESSION['admin']!=3 ){}
else
header('location:side.php');
//select query to list 
// Edit admin
//to show data in the input field
$name = '';
$price = '';
if (isset($_GET['Edit2'])) {
    $proID = $_GET['Edit2'];
    //select query
    $Select = "SELECT products.proName,products.proPrice, sections.sectionName FROM sections,products WHERE proID = '$proID' AND sections.sectionID=products.sectionid";
    //run query 
    $run = mysqli_query($conn, $Select);
    //to get the specific row 
    $row = mysqli_fetch_assoc($run);
    $name = $row['proName'];
    $price = $row['proPrice'];
}
//update 
if (isset($_POST['uppro'])) {
    // image
    $imagetype = $_FILES['proimage']['type'];
    $imagename = $_FILES['proimage']['name'];
    $temporaryname = $_FILES['proimage']['tmp_name'];
    $location = './upload/';
    if (move_uploaded_file($temporaryname,$location.$imagename)){
        echo "image uploaded";
    }
    else 
    echo "failed";
    $productname = $_POST['proname'];
    $productprice = $_POST['proprice'];
    $adminname = $_POST['adname'];
    $sectionna= $_POST['secname'];
    //update query
    $update = "UPDATE `products` SET proName = '$productname' , proPrice = '$productprice' , proImage = '$imagename'
    , adminpid = '$adminname', sectionid = '$sectionna' WHERE proID = '$proID'";
    //run the query
    $run = mysqli_query($conn, $update);
    if ($run) {
        header('location:listproduct.php ');
    } else {
        echo '<script language="javascript">';
        echo 'alert("NO")';
        echo '</script>';
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
                    <div class="row row-cols-1 row-cols-md-3">
                        <?php
                        foreach ($run as $data) { ?>
                            <div class="col mb-4">
                                <div class="card h-100">
                                    <img name="proimage" src="./e-commerce project/upload/<?php echo $data['proImage'] ?>" class="card-img-top">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $data['proName']; ?></h5>
                                        <p class="card-text"><?php echo $data['proPrice']; ?></p>
                                        <p class="card-text"><?php echo $data['sectionName']; ?></p>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <a href="#" class="btn btn-primary btn-block">Want to buy it ?</a>
                                            </div>
                                            <div class="col-lg-6 mt-2">
                                                <a href="listproduct.php?Edit2=<?php echo $data['proID']; ?>" name="Edit2" class="btn btn-primary ml-5">Edit</a>
                                            </div>
                                            <div class="col-lg-6 mt-2">
                                                <a href="listproduct.php?Delete2=<?php echo $data['proID']; ?>" name="Delete2" class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="form">
                        <div class="row">
                            <div class="col-lg-12">
                                <section class="panel">
                                    <div class="panel-body">
                                        <div class="form">
                                            <form class="form-horizontal " method="POST" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label class="control-label col-lg-2" style="font-family: cursive; font-size:large; color: #79810a" for="inputSuccess">Product Name</label>
                                                    <div class="col-lg-10">
                                                        <input class="form-control input-lg m-bot15" name="proname" value="<?php echo $name?>" type="text">
                                                    </div>
                                                    <label class="control-label col-lg-2" style="font-family: cursive; font-size:large; color: #79810a" for="inputSuccess">Product Price</label>
                                                    <div class="col-lg-10">
                                                        <input class="form-control input-lg m-bot15" name="proprice" value="<?php echo $price?>" type="text">
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
                                                        <button class="btn btn-success" name="uppro" type="submit" title="Bootstrap 3 themes generator">Update Product</a>
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