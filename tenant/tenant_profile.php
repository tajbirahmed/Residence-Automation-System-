<?php 
    header("Cache-Control: no-cache, must-revalidate"); 
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    session_start();
    include_once('../connect.php'); 
    if (isset($_SESSION['email']) && isset($_SESSION['type'])) {
        $type = $_SESSION['type']; 
         if (isset($_GET['aid'])) {
            $aid = $_GET['aid'];
            if (!empty($aid)) {
                $sql = "SELECT * from `tenant` where ApartmentID='$aid' limit 1";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    $row = mysqli_fetch_assoc($result); 
                    $fname = $row['first_name'];
                    $lname = $row['last_name'];
                    $phone = $row['phone'];
                    $email = $row['email'];
                    $nid = $row['nid']; 
                    $fdesc = $row['fdesc']; 
                    $img = $row['image'];
                    $nid_img = $row['nid_image'];
                    $reg_date = $row['registerddate'];
                }
                $tmpaid = $aid . '@ras.com';
                $sql = "SELECT * from user where username='$tmpaid'"; 
                $result = mysqli_query($con, $sql);

                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    $pass = $row['password'];
                }
            }
            if (isset($_POST['submit'])) {
                $cpass = $_POST['password']; 
                if (!empty($cpass) && $pass != $cpass) {
                    $sql = "UPDATE user 
                                set password = '$cpass' 
                                where username='$tmpaid'";
                    mysqli_query($con, $sql);
                    
                    header('Location: ../ProfileSystem/login.php');
                }
            }
            if (isset($_POST['update'])) {
                $ufname = $_POST['fname']; 
                $ulname = $_POST['lname']; 
                $uphone = $_POST['phone']; 
                $ufdesc = $_POST['fdesc'];
                $uemail = $_POST['email']; 
                $unid = $_POST['nid_no']; 
                $image = $_FILES['image']; 
                $nid_image = $_FILES['nid_image']; 

                if (!empty($ufname) && !empty($ulname) && !empty($uphone) &&
                    !empty($uemail) && !empty($unid)) {
                    $sql = "UPDATE `tenant` 
                            set first_name='$ufname', last_name = '$ulname', phone = '$uphone', 
                                email = '$uemail', nid = '$unid', fdesc = '$ufdesc' 
                                where ApartmentID='$aid'";
                    $result = mysqli_query($con, $sql); 
                    $extensions = array('jpeg', 'jpg', 'png');
                    if (!empty($image['name'])) {
                        $filename_image = explode('.', $image['name']); 
                        
    
                        if (in_array(strtolower($filename_image[1]), $extensions)) {
                            $upload_image = '../images/tenant/'. $aid . '.' . $filename_image[1];
                            move_uploaded_file($image['tmp_name'], $upload_image); 
                            
                            // $upload_image = 'tenant/' . $aid . '.' . $filename_image[1];
                            // $upload_nid_image = 'nid/' . $aid . '.' . $filename_nid_image[1];
                        }
                    }
                    if (!empty($nid_image['name'])) {
                        $filename_nid_image = explode('.', $nid_image['name']);
                        if (in_array(strtolower($filename_nid_image[1]), $extensions)) {
                            $upload_nid_image = '../images/nid/'. $aid . '.' . $filename_nid_image[1];
                            move_uploaded_file($nid_image['tmp_name'], $upload_nid_image);
                        }
                    }
                    header('Location: ../Building/tenant_info.php?aid='.$aid.'');
                    if ($result) {
                        // success 
                        
                        

                    } else {
                        // fail
                    }
                } else {
                    // one or multiple field is empty
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

        <title>TENANT PROFILE</title>
    </head>
    <body>
        <?php require_once('../home/_nav_from_show_building_info.php');?>
        <div class="container my-4">
            <form method="post" enctype="multipart/form-data">
            
                <div class="form-group">
                    <label for="fname">First Name</label>
                    <input type="text" class="form-control" name="fname" <?php if ($type=='tenant') echo 'readonly'; ?> value="<?php echo $fname?>">
                </div>
                
                <div class="form-group">
                    <label for="lname">Last Name</label>
                    <input type="text" class="form-control" name="lname" <?php if ($type=='tenant') echo 'readonly'; ?> value="<?php echo $lname?>">
                </div>

                <div class="form-group">
                    <label for="lname">Phone</label>
                    <input type="text" class="form-control" name="phone" <?php if ($type=='tenant') echo 'readonly'; ?> value="<?php echo $phone;?>">
                </div>

                <div class="form-group">
                    <label for="lname">Email</label>
                    <input type="email" class="form-control" name="email" <?php if ($type=='tenant') echo 'readonly'; ?> value="<?php echo $email;?>">
                </div>
                
                <div class="form-group">
                    <label for="lname">NID</label>
                    <input type="text" class="form-control" name="nid_no" <?php if ($type=='tenant') echo 'readonly'; ?> value="<?php echo $nid;?>">
                </div>
                
                <div class="form-group">
                    <label for="lname">Family Description</label>
                    <input type="text" class="form-control" name = "fdesc" <?php if ($type=='tenant') echo 'readonly'; ?> value="<?php echo $fdesc;?>">
                </div>
                <div class="form-group">
                    <label for="lname">Registered Date</label>
                    <input type="text" class="form-control" readonly value="<?php echo $reg_date;?>">
                </div>
                <div class="form-group my-2">
                    <label for="lname">Image</label>
                    <img src="../images/<?php echo $img?>" style="width: 300px;">
                </div>
                <?php 
                    if ($type == 'owner') {
                        echo '<input type="file" accept=".jpg,.jpeg,.png" name="image">';
                    }
                ?>
                <div class="form-group my-2">
                    <label for="lname">NID image</label>
                    <img src="../images/<?php echo $nid_img?>" style="width: 600px;">
                </div>
                <?php 
                    if ($type == 'owner') {
                        echo '<input type="file" accept=".jpg,.jpeg,.png" name="nid_image">';
                    }
                    if ($type == 'tenant'){
                            echo '  <div class="form-group">
                                    <label for="lname">Password</label>
                                    <input type="text" class="form-control" name="password" value="'.$pass.'">
                                    </div>';
                            echo '<button type="submit" class="btn btn-dark" name="submit">Submit</button>';
                    }
                    if ($type == 'owner') {
                        echo '<button type="submit" class="btn btn-dark" name="update">Confirm Update</button>';
                    }
                ?>

            </form>

        </div>
    </body>
</html>

