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

if (isset($_POST['addsec'])){
    $sectionname =filter_var($_POST['secname'] , FILTER_SANITIZE_STRING) ; 
    $adminname = $_POST['adname'];
    $Select = "SELECT * FROM admins WHERE adminID=$adminname";
    if($Select){
    //insert query 
    $insert = "INSERT INTO `sections` VALUES (NULL , '$adminname' , '$sectionname')";}
    else
    echo "Inserted failed";
    //run query
    $run = mysqli_query($conn , $insert);
    //check
    if ($run){
        header('location: listsection.php');
    }
    else{
        $msg =mysqli_error($conn);
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
                                    <label class="control-label col-lg-2" style="font-family: cursive; font-size:large; color: #79810a" for="inputSuccess">Section Name</label>
                                    <div class="col-lg-10">
                                        <input class="form-control input-lg m-bot15" name ="secname" type="text">
                                    </div>
                                    <label class="control-label col-lg-2" style="font-family: cursive; font-size:large; color: #79810a" for="inputSuccess">Pick your name</label>
                                    <div class="col-lg-10">
                                        <select name="adname" class="form-control input-lg m-bot15">
                                            <?php 
                                            //select query
                                            $select = "SELECT * FROM `admins`";
                                            //run the query
                                            $run = mysqli_query($conn , $select);
                                            foreach( $run as $data){
                                            ?>
                                            <option value="<?php echo $data['adminID']?>">
                                            <?php echo $data['adminName'] ?>
                                            </option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class = "col-lg-5"></div>
                                    <div class = "col-lg-7">
                                    <button class="btn btn-success" name = "addsec" type="submit" title="Bootstrap 3 themes generator">Add section</a>
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