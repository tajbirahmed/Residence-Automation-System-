<?php 
Session_start();
    include_once('../connect.php'); 
        
        $temp = explode('@', $_SESSION['email']);
        $aid = $temp[0]; 
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
            }
            $aid = $aid . '@ras.com';
            $sql = "SELECT * from user where username='$aid'"; 
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
                            where username='$aid'";
                mysqli_query($con, $sql);
                
                header('Location: ../ProfileSystem/login.php');
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
                    <input type="text" class="form-control" id="fname" name="fname" readonly value=<?php echo $fname?>>
                </div>
                
                <div class="form-group">
                    <label for="lname">Last Name</label>
                    <input type="text" class="form-control" id="lname" readonly value=<?php echo $lname?>>
                </div>

                <div class="form-group">
                    <label for="lname">Phone</label>
                    <input type="text" class="form-control" id="phone" readonly value=<?php echo $phone?>>
                </div>

                <div class="form-group">
                    <label for="lname">Email</label>
                    <input type="email" class="form-control" id="phone" readonly value=<?php echo $email?>>
                </div>
                
                <div class="form-group">
                    <label for="lname">NID</label>
                    <input type="text" class="form-control" id="phone" readonly value=<?php echo $nid?>>
                </div>
                
                <div class="form-group">
                    <label for="lname">Family Description</label>
                    <input type="text" class="form-control" id="phone" readonly value=<?php echo $fdesc?>>
                </div>
                
                <div class="form-group">
                    <label for="lname">Image</label>
                    <img src="../images/<?php echo $img?>" style="width: 300px;">
                </div>
                <div class="form-group">
                    <label for="lname">NID image</label>
                    <img src="../images/<?php echo $nid_img?>" style="width: 600px;">
                </div>
                
                <div class="form-group">
                    <label for="lname">Password</label>
                    <input type="text" class="form-control" id="phone" name="password" value=<?php echo $pass?>>
                </div>
                

                <button type="submit" class="btn btn-dark" name="submit">Submit</button>
            </form>

        </div>
    </body>
</html>

