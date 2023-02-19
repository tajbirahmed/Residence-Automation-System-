<?php
include_once('../connect.php'); 
    if (isset($_GET['id'])) {
        $email = $_GET['id']; 
        if (!empty($email)) {
            if (isset($_POST['submit'])) {
                if (isset($_POST['hld']) && isset($_POST['bname'])) {
                    $hld = $_POST['hld']; 
                    $bname = $_POST['bname']; 
                    if (!empty($hld) && !empty($bname)) {
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
                            mysqli_query($con, $sql);
                            
                           
                            $sql = "INSERT into own (`email`, `holdingNumber`) values ('$email', '$hld')"; 
                            
                            mysqli_query($con, $sql);
                            
                            
                            header('location:../ownerInterface.php');
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
    <div class="container">
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
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    </body>
</html>
