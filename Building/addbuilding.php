<?php
session_start();
include_once('../connect.php'); 
    if (isset($_GET['id'])) {
        $email = $_GET['id']; 
        if (!empty($email)) {
            if (isset($_POST['submit'])) {
                if (isset($_POST['hld']) && isset($_POST['bname']) && isset($_POST['city']) 
                && isset($_POST['thana'])&& isset($_POST['area'])&& isset($_POST['street']) 
                && isset($_POST['hno'])) { 
                    $hld = $_POST['hld']; 
                    $bname = $_POST['bname'];
                    $city =  $_POST['city']; 
                    $thana = $_POST['thana']; 
                    $area = $_POST['area']; 
                    $street = $_POST['street']; 
                    $hno = $_POST['hno'];
                    if (!empty($hld) && !empty($bname) && !empty($city) && 
                        !empty($thana) && !empty($area) && !empty($street) && 
                        !empty($hno)) {
                        $image = $_FILES['image'];
                    
                        $filename = explode('.', $image['name']); 
                        $extensions = array('jpeg', 'jpg', 'png');
                        if (in_array(strtolower($filename[1]), $extensions)) {
                            $upload_image = '../images/building/'. $hld . '.' . $filename[1];
                            move_uploaded_file($image['tmp_name'], $upload_image);

                            $sql = "SELECT * from owner where email='$email'";
                            $result = mysqli_query($con, $sql); 
                            $row = mysqli_fetch_assoc($result); 

                            
                            $upload_image = 'building/' . $hld . '.' . $filename[1];
                            $sql = "INSERT into building (`holdingNumber`, `buildingName`, `image`) 
                                                    values ('$hld', '$bname', '$upload_image')"; 
                            $result1 = mysqli_query($con, $sql);
                            
                           if ($result1) {
                                $sql = "INSERT into own (`email`, `holdingNumber`) values ('$email', '$hld')"; 
                            
                                $result2 = mysqli_query($con, $sql);
                                if ($result2) {
                                    $sql = "INSERT into location (`holdingNumber`, `city`, `thana`, `area`, `street`, `houseno`) 
                                                        values('$hld', '$city', '$thana', '$area', '$street', '$hno')";
                            
                                    $result3 = mysqli_query($con, $sql);
                                    if ($result3) {
                                        header('location:../ownerInterface.php');
                                        // success 
                                    } else {
                                        // failure-at-level-3
                                    }
                                } else {
                                    // failure - at-level-2
                                }
                           }

                        } else {
                            // failure-at-level-1
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>INSERT</title>
    </head>
    <body>
        <?php 
             require_once('../home/_nav_from_show_building_info.php');
        ?>
    <div class="container my-5">
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Holding Number</label>
                <input type="number" name="hld" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Holding">
            </div>
            <div class="form-group">
                <label>Building Name</label>
                <input type="text" name="bname" class="form-control" id="exampleInputPassword1" placeholder="Enter Building Name">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Image</label> <br>
                <input type="file" accept=".jpg,.jpeg,.png" name="image" id="fileToUpload">
            </div>

            <div class="form-group">
                <label>City</label>
                <input type="text" name="city" class="form-control" placeholder="Enter City*">
            </div>
            <div class="form-group">
                <label>Thana</label>
                <input type="text" name="thana" class="form-control" placeholder="Enter Thana*">
            </div>
            <div class="form-group">
                <label>Area</label>
                <input type="text" name="area" class="form-control" placeholder="Enter Area**">
            </div>
            <div class="form-group">
                <label>Street No.</label>
                <input type="text" name="street" class="form-control" placeholder="Enter Street No.**">
            </div>
            
            <div class="form-group">
                <label>House No.</label>
                <input type="text" name="hno" class="form-control" placeholder="Enter House No.**">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    </body>
</html>
