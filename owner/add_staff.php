<?php
    include_once('../connect.php');
    if (isset($_GET['hld'])) {
        $hld = $_GET['hld']; 
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $phone = $_POST['phone']; 
            $image = $_FILES['image']; 
            $date = $_POST['date'];
            $salary = $_POST['salary'];
            $sql = "INSERT INTO `staff` (`holdingNumber`, `name`, `phone`, `joining_date`, `salary`) 
                                    values('$hld', '$name', '$phone', '$date', '$salary')"; 
            mysqli_query($con, $sql);

            $sql = "SELECT 	staffid from `staff` where name = '$name' and phone = '$phone' and holdingNumber = '$hld' and joining_date = '$date' limit 1"; 
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result); 
            $id = $row['staffid']; 
            

            $filename = explode('.', $image['name']); 
            $extensions = array('jpeg', 'jpg', 'png');
            if (in_array(strtolower($filename[1]), $extensions)) {
                $upload_image = '../images/staff/'. $id . '.' . $filename[1];
                move_uploaded_file($image['tmp_name'], $upload_image); 
                
                $upload_image = 'staff/' . $id . '.' . $filename[1];
                
                $sql = "UPDATE`staff` set image = '$upload_image' where name = '$name' and phone = '$phone' and holdingNumber = '$hld'";

                mysqli_query($con, $sql);
                header('Location: view_staff.php?id='.$hld.'&staff_add=1');
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

        <title>Hello, world!</title>
    </head>
    <body>
    <?php require_once('../home/_nav_from_show_building_info.php'); ?>    
    <div class="container my-5" style="width: 40%;">
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" name="name" required class="form-control" placeholder="Enter name*">
            
            </div>
            <div class="form-group">
            <label>Phone</label>
            <input required name = "phone" type="number" required class="form-control" id="exampleInputPassword1" placeholder="*">
            </div>
            <div class="form-group">
            <label>Salary</label>
            <input required name = "salary" type="number" required class="form-control" id="exampleInputPassword1" placeholder="*">
            </div>
            <div class="form-group">
            <label>Joining Date</label>
            <input required name = "date" type="date" required class="form-control" id="exampleInputPassword1" placeholder="*">
            </div>
            <div class="form-group">
            <label>Image</label>
            <input required name = "image" type="file" accept=".jpg, .jpeg, .png" required class="form-control" placeholder="">
            </div>
            
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form></div>
    </body>
</html>
