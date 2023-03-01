<?php 
session_start();
    include_once('../../connect.php'); 
    if (isset($_GET['aid']) && isset($_GET['hld'])) {
        $aid = $_GET['aid']; 
        $hld = $_GET['hld'];
        // Updating information of a tenant 
        // by owner
        if (isset($_POST['fname']) && 
            isset($_POST['lname']) && 
            isset($_POST['phone']) && 
            isset($_POST['email']) && 
            isset($_POST['NID']) && 
            isset($_POST['fdesc']) ) { 

            $fname = $_POST['fname']; 
            $lname = $_POST['lname']; 
            $phone = $_POST['phone']; 
            $email = $_POST['email']; 
            $nid = $_POST['NID']; 
            $fdesc = $_POST['fdesc']; 
            $date = $_POST['date'];
            $mon = $_POST['money']; 
            if (!empty($fname) && !empty($lname) && !empty($phone) && !empty($email) && !empty($nid) && !empty($fdesc)) {
                // Inserting information about tenant.
                // by owner 
                $image = $_FILES['image']; 
                $nid_image = $_FILES['nidimage']; 
                if (!empty($image) && !empty($nid_image)) {
                    $filename_image = explode('.', $image['name']); 
                    $extensions = array('jpeg', 'jpg', 'png');
                    $filename_nid_image = explode('.', $nid_image['name']);

                     if (in_array(strtolower($filename_image[1]), $extensions) && in_array(strtolower($filename_nid_image[1]), $extensions)) {
                        $upload_image = '../../images/tenant/'. $aid . '.' . $filename_image[1];
                        move_uploaded_file($image['tmp_name'], $upload_image); 
                        $upload_nid_image = '../../images/nid/'. $aid . '.' . $filename_nid_image[1];
                        move_uploaded_file($nid_image['tmp_name'], $upload_nid_image);
                        $upload_image = 'tenant/' . $aid . '.' . $filename_image[1];
                        $upload_nid_image = 'nid/' . $aid . '.' . $filename_nid_image[1];
                    $sql = "INSERT INTO `tenant` 
                        (`apartmentid`, `first_name`, `last_name`, `phone`, `email`, `image`, `nid`, `fdesc`, `nid_image`, `registerddate`, `advanced_amount`) 
                        VALUES ('$aid', '$fname', '$lname', '$phone', '$email', '$upload_image', '$nid', '$fdesc', '$upload_nid_image', '$date', '$mon')";
                    mysqli_query($con, $sql); 
                    
                    // Creating an account for tenant in user table
                    // default password sets NID
                    $username = $aid . '@ras.com';
                    $sql = "INSERT into `user` (`username`, `password`, `type`) 
                                        values('$username', '$nid', 'tenant')"; 
                    mysqli_query($con, $sql);
                    // Updating availability 
                    // because tenant addition means apartment is not available
                    $sql = "UPDATE apartment set availability = 0 where ApartmentID='$aid'"; 
                    mysqli_query($con, $sql);

                    header('Location: ../../owner/showBuildinginfo.php?showHolding='.$hld.'');
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
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"> 
            <title>TENANT</title>
        </head>
        <body>
            <?php
                require_once('../../home/_nav_from_aparmtent_view.php');
            ?>
            <div class="container my-5">
                <form method="post" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">First Name</label>
                        <input name = "fname"  required type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter first name">
                        
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Last Name</label>
                        <input name = "lname"  required type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter last name">
                        
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phone</label>
                        <input name = "phone"  required type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter phone">
                        
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input name = "email"  required type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">NID NO</label>
                        <input name = "NID" required type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter NID">
                        
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Family Description</label>
                        <input name = "fdesc" required type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter small description of family">
                        
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Advance Amount</label>
                        <input name = "money" required type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter advance amount">
                        
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Check in Date</label>
                        <input name = "date" required type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Nid Image">
                        
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Image</label>
                        <input name = "image" required accept=".jpg,.jpeg,.png" type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter image">
                        
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Nid Image</label>
                        <input name = "nidimage" required accept=".jpg,.jpeg,.png" type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Nid Image">
                        
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            </div>
        </body>
</html>
