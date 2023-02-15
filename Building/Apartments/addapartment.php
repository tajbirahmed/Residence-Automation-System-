<?php
session_start();  
    include('../../connect.php');
    if (isset($_GET['id'])) {
        $hld = $_GET['id']; 
        if (!empty($hld)) {
            if (isset($_POST['aid']) && 
                isset($_POST['rpm']) && 
                isset($_POST['size']) && 
                isset($_POST['bhk'])) {
                    if (!empty($_POST['aid']) && 
                    !empty($_POST['rpm']) && 
                    !empty($_POST['size']) && 
                    !empty($_POST['bhk'])){
                        $size = $_POST['size']; 
                        $rpm = $_POST['rpm']; 
                        $aid = $_POST['aid']; 
                        $bhk = $_POST['bhk'];

                        $sql = "INSERT INTO `apartment` (`ApartmentID`, `holdingNumber`,`rentpermonth`, `size`, `BHK`) 
                                VALUES ('$aid', '$hld' ,'$rpm', '$size', '$bhk')";

                        mysqli_query($con, $sql);
                        header('Location: ../../owner/showBuildinginfo.php?showHolding='.$hld.'');
                    }
                }
        }
    }
?>

<!doctype html>
<html lang="en">
    <head>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">    
        <title>Residence Automation System</title>
    </head>
    <body>
        <div class="container my-6" style ="width: 50%">
        <form method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Apartment ID</label>
                <input type="text" name="aid" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Aparment ID">
                </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Rent Per Month</label>
                <input type="number" name = "rpm" class="form-control" id="exampleInputPassword1" placeholder="Enter Rent Per Month">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Size</label>
                <input type="number" name = "size" class="form-control" id="exampleInputPassword1" placeholder="Enter Size">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">BHK</label>
                <input type="number" name="bhk" class="form-control" id="exampleInputPassword1" placeholder="BHK">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </body>
</html>