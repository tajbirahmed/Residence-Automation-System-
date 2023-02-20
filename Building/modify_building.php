<?php 
    header("Cache-Control: no-cache, must-revalidate"); 
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    session_start(); 
    include_once('../connect.php');
    if (isset($_SESSION['email'])) {
        $alert = false;
        if (isset($_GET['id'])) {
            $hld = $_GET['id'];
            if (!empty($hld)) {
                $sql = "SELECT * from building where holdingNumber=$hld limit 1"; 
                $result = mysqli_query($con, $sql);
                $row = mysqli_fetch_assoc($result);
                $bname = $row['buildingName']; 
                $img = $row['image']; 
                $sql = "SELECT * from location where holdingNumber=$hld limit 1"; 
                $result = mysqli_query($con, $sql);
                $row = mysqli_fetch_assoc($result);
                $street = $row['street']; 
                $city = $row['city']; 
                $area = $row['area']; 
                $thana = $row['thana'];
                $houseno = $row['houseNo'];

            }
            if (isset($_GET['action']) && $_GET['action'] == 'update'){
                $delete = false;
                $readonly = false;
                if (isset($_POST['submit'])) {
                    $ubname = $_POST['bname'];
                    $uimg = $_FILES['uimage'];
                    $uhouseno = $_POST['hno']; 
                    $uarea = $_POST['area']; 
                    $uthana = $_POST['thana']; 
                    $ustreet = $_POST['street'];

                    if ((!empty($ubname) && 
                        !empty($uhouseno) && !empty($uarea) 
                        && !empty($uthana)) || !empty($uimg['name'])) {
                                
                            if ($ubname != $bname) {
                                $sql = "UPDATE `building` 
                                            set buildingName='$ubname'
                                            where holdingNumber=$hld";
                                mysqli_query($con, $sql);
                            } 

                            if ($uhouseno != $houseno || $ustreet != $street ||
                                $uarea != $area || $uthana != $thana) {
                                $sql = "UPDATE `location` 
                                            set houseNo='$uhouseno', street='$ustreet', area='$uarea', thana='$uthana'
                                            where holdingNumber=$hld";
                                mysqli_query($con, $sql);
                            }
                                
                            if (!empty($uimg['name'])) {
                                
                                $filename = explode('.', $uimg['name']); 
                                $extensions = array('jpeg', 'jpg', 'png');
                                if (in_array(strtolower($filename[1]), $extensions)) {
                                    $upload_image = '../images/building/'. $hld . '.' . $filename[1];
                                    move_uploaded_file($uimg['tmp_name'], $upload_image); 
                                }
                            }


                            if ($ubname != $bname || $uhouseno != $houseno || 
                                $uarea != $area || $uthana != $thana || 
                                $ustreet != $street || !empty($uimg['name']))   {
                                $update = 'update';
                                    header('Location: modify_building.php?id='.$hld.'&action='.$update.'');
                                
                            }
                    } else {
                        // one or multiple field is empty
                        // handle to-do
                    }

                    
                }
            }
            if (isset($_GET['action']) && $_GET['action'] == 'delete') {
                $delete = true;
                $readonly=true;
                $email = $_SESSION['email'];
                if (isset($_POST['delete'])) {
                    if (isset($_POST['password'])){
                        $sql = "SELECT * from `user` where username='$email' limit 1";
                        $result = mysqli_query($con, $sql);
                        $row = mysqli_fetch_assoc($result); 

                        if ($row['password'] == $_POST['password']) {
                            // delete building 
                            // 
                            
                        } else {
                            $alert  = true; 
                        }
                    }
                
                }

            }
        }
    }
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Update Building</title>
    </head>
    <body>
        
        <?php 
            require_once('../home/_nav_from_show_building_info.php');
            
            if ($alert) {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Wrong Password</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>'; 
              $alert=false; 
            }
            if ($delete) {
                echo '<h1 style="text-align: center;">Delete Building</h1>';
            } else {
                echo '<h1 style="text-align: center;">Update Building</h1>';
            }
        ?>

        <div class="container my-5">
        <form method="post" enctype="multipart/form-data">
            
            <div class="form-group">
                <label for="exampleInputEmail1">Building Name</label>
                <input type="text" name="bname" <?php if ($readonly) echo 'readonly';?> value = "<?php echo $bname;?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Building Name">
            </div>
            
            
            <div class="form-group">
                <label for="exampleInputEmail1">Holding Number</label>
                <input type="text" readonly value = "<?php echo $hld;?>"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Holding Number">
            </div>
            
            
            <div class="form-group">
                <label for="exampleInputEmail1">Image</label>
                <img src="../images/<?php echo $img . '?rand=' . rand();?>" style="width: 150px;"/>
                <?php
                    if (!$readonly){
                        echo '<input type="file" value = "<?php echo $img;?>" name ="uimage" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">';
                    }                
                ?>
            </div>
            
            
            <div class="form-group">
                <label for="exampleInputEmail1">Location</label> <br>
                
                <label for="Hoouse No">House No</label>
                <input type="text" name = "hno" <?php if ($readonly) echo 'readonly';?> value = "<?php echo $houseno;?>"id = "hno" class="form-control" id="House No" aria-describedby="emailHelp" placeholder="Enter email">
                
                <label for="street">Street</label>
                <input type="text" name ="street" <?php if ($readonly) echo 'readonly';?> value = "<?php echo $street;?>"id="street"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                
                <label for="area">Area</label>
                <input type="text" name="area" <?php if ($readonly) echo 'readonly';?> id="area" value = "<?php echo $area;?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                
                <label for="thana">Thana</label>
                <input type="text" name="thana" <?php if ($readonly) echo 'readonly';?> id="thana" value = "<?php echo $thana;?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">

                <label for="area">City</label>
                <input type="text" name="city" id="city" readonly value = "<?php echo $city;?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            
            
                    <?php 
                        echo '<br>';
                        if (isset($_GET['action']) && $_GET['action'] == 'update'){
                            echo '<button type="submit" name="submit" class="btn btn-primary">Submit</button>';
                        }
                        if (isset($_GET['action']) && $_GET['action'] == 'delete') {
                            echo '<label for="password">Owner Password</label>';
                            echo '<input type="text" name="password" id="password" class="form-control" placeholder="Enter your password to confirm delete"><br>';
                            echo '<button type="submit" name="delete" class="btn btn-danger">Confirm Delete</button>';
                        }
                    ?>
                </div>
            </form>
        </div>
        
    </body>
</html>
