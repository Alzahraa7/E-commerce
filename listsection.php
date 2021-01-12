<!-- backend -->
<?php
ob_start();
include "./side.php";
//routes secure
if ($_SESSION['admin']){}
else
header('location:login.php');
if ($_SESSION['admin']!=5 ){}
else
header('location:side.php');
//select query to list 
$select = "SELECT sections.sectionID, admins.adminName ,sectionName FROM sections,admins WHERE sections.adminsid= adminID";
//run the query
$run = mysqli_query($conn, $select);
// Edit admin
//to show data in the input field
$name ='';
if (isset($_GET['Edit1'])){
    $sectionID = $_GET['Edit1'];
    //select query
    $Select = "SELECT sections.sectionID, admins.adminName ,sectionName FROM sections,admins WHERE sectionID = '$sectionID' AND sections.adminsid= adminID";
    //run query 
    $run = mysqli_query($conn , $Select);
    //to get the specific row 
    $row = mysqli_fetch_assoc($run);
    $name = $row ['sectionName'];
}
//update 
if (isset($_POST['upsec'])){
    $sectionname = $_POST['secname'];
    $adname = $_POST['adname'];
    //update query
    $update = "UPDATE `sections` SET sectionName = '$sectionname' , adminsid = '$adname' WHERE sectionID = '$sectionID'";
    //run the query
    $run = mysqli_query($conn , $update);
    if ($run){
        header('location:listsection.php ');
    }
    else{echo '<script language="javascript">';
        echo 'alert("NO")';
        echo '</script>';
             }
    
}

//delete admin 
if (isset($_GET['Delete1'])) {
    $sectionid = $_GET['Delete1'];
    //delete query 
    $delete = "DELETE FROM `sections` WHERE `sectionID` = '$sectionid'";
    //run query
    $run = mysqli_query($conn, $delete);
    if ($run) {
        echo "hello";
        header('location:listsection.php');
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
                                            <th><i class="icon_profile"></i> Section Name</th>
                                            <th><i class="icon_mail_alt"></i> Admin name</th>
                                            <?php if($_SESSION['admin'] != 3) :?>
                                            <th><i class="icon_cogs"></i> Action</th>
                                            <?php endif;?>
                                        </tr>
                                        <?php foreach ($run as $data) { ?>
                                            <tr>
                                                <td><?php echo $data['sectionID']; ?></td>
                                                <td><?php echo $data['sectionName'] ?></td>
                                                <td><?php echo $data['adminName'] ?></td>
                                                <?php if($_SESSION['admin'] != 3) :?>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="listsection.php?Edit1=<?php echo $data['sectionID'];?>" name="Edit1" class="btn btn-primary "><i class="icon_plus_alt2"></i></a>
                                                        <a href="listsection.php?Delete1=<?php echo $data['sectionID']; ?>" name="Delete1" class="btn btn-danger"><i class="icon_close_alt2"></i></a>
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
                                <?php if($_SESSION['admin'] != 3) :?>
                                    <div class="panel-body">
                                        <div class="form">
                                        <form class="form-horizontal " method="POST">
                                <div class="form-group">
                                    <label class="control-label col-lg-2" style="font-family: cursive; font-size:large; color: #79810a" for="inputSuccess">Section Name</label>
                                    <div class="col-lg-10">
                                        <input class="form-control input-lg m-bot15" name ="secname" value="<?php echo $name ?>" type="text">
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
                                    <button class="btn btn-success" name = "upsec" type="submit" title="Bootstrap 3 themes generator">Update section</a>
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