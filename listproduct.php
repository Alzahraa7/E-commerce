<!-- backend -->
<?php
ob_start();
include "./side.php";
//routes secure
if ($_SESSION['admin']|| $_SESSION['customer']){}
else
header('location:login.php');
if ($_SESSION['admin']!=5 ){}
else
header('location:side.php');
//select query to list 
$select = "SELECT *,sectionName FROM `products`,sections WHERE sections.sectionID = products.sectionid";
//run the query
$run = mysqli_query($conn, $select);
//delete admin 
if (isset($_GET['Delete2'])) {
    $productid = $_GET['Delete2'];
    //delete query 
    $delete = "DELETE FROM `products` WHERE `proID` = '$productid'";
    //run query
    $run = mysqli_query($conn, $delete);
    if ($run) {
        echo "hello";
        header('location:listproduct.php');
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
                                        <?php if($_SESSION['admin']) {}
                                        else{
                                        ?>
                                            <div class="col-lg-12">
                                                <a href="addorder.php?take=<?php echo $data['proID'];?>" class="btn btn-primary btn-block">Want to buy it ?</a>
                                            </div>
                                        <?php }?>
                                            <?php if($_SESSION['admin'] != 3) :?>
                                            <div class="col-lg-6 mt-2">
                                                <a href="updateproduct.php?Edit2=<?php echo $data['proID']; ?>" name="Edit2" class="btn btn-primary ml-5">Edit</a>
                                            </div>
                                            <div class="col-lg-6 mt-2">
                                                <a href="listproduct.php?Delete2=<?php echo $data['proID']; ?>" name="Delete2" class="btn btn-danger">Delete</a>
                                            </div>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
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