<?php 
session_start();  
    include_once('../../connect.php'); 

    if (isset($_POST['min'])) {
        $min = $_POST['min']; 
    } 
    if (empty($min)) {
        $min = 0; 
    }
    if (isset($_POST['max'])) {
        $max = $_POST['max']; 
    }
    if (empty($max)) {
        $max = 1000000; 
    } 
    if (isset($_POST['size'])) {
        $size = $_POST['size']; 
    } 
    if (empty($size)) {
        $size = -1;
    }
    if (isset($_POST['city'])) {
        $city = $_POST['city']; 
    } 
    if (empty($city)) {
        $city = '-'; 
    }
    if (isset($_POST['area'])) {
        $area = $_POST['area']; 
    } 
    if (empty($area)) {
        $area = '-'; 
    }
    if (isset($_POST['thana'])) {
        $thana = $_POST['thana']; 
    } 
    if (empty($thana)) {
        $thana = '-'; 
    }
    
    $sqlLO = "SELECT * 
            from location l, apartment a, building b
            where l.holdingNumber = a.holdingNumber and l.holdingNumber = b.holdingNumber and 
                    a.availability = 1 and 
                    a.rentpermonth between $min and $max and 
                    ($size = -1 or a.BHK = $size) and 
                    ('$city' = '-'  or l.city = '$city') and 
                    ('$area' = '-'  or l.area = '$area') and 
                    ('$thana' = '-'  or l.thana = '$thana')";
    
    $requltLO = mysqli_query($con, $sqlLO);  
    
    
    
    
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
        <?php require_once('../../home/_nav_from_aparmtent_view.php'); ?>
        <div class="container my-5">
        <form method="post" action="index.php">
            <div class="form-group">
                <label for="exampleInputEmail1">Rent</label>
                <input type="number" name = "min" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder = "min"style="width: 100px">
                <input type="number" name = "max" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder = "max"style="width: 100px">
            </div>
            
            <div class="form-group">
                <label for="exampleInputPassword1">Size</label>
                <input name = "size" type="number" class="form-control" id="exampleInputPassword1" placeholder="BHK" style="width: 100px">
            </div>
            <label for="exampleInputPassword1">Location</label>
            <div class="form-group" style="width: 300px;">
                <label for="user">Choose Your City:</label>
                                    <?php
                                        include_once('../../connect.php'); 
                                        $sql1 = "select distinct city from location"; 
                                        $result1 = mysqli_query($con, $sql1); 
                                    ?>
                                <select name="city" id="" style="width: 400px;"> 
                                    <?php
                                        while ($row1 = mysqli_fetch_assoc($result1)) {
                                            $city = $row1['city']; 
                                            echo '<option value="'.$city.'">'.$city.'</option>';
                                        }
                                    ?>

                                </select>
            </div>
            <div class="form-group" style="width: 300px;">
                <label for="user">Choose Your Area:</label>
                                    <?php
                                        include_once('../../connect.php'); 
                                        $sql1 = "select distinct area from location"; 
                                        $result1 = mysqli_query($con, $sql1); 
                                    ?>
                                <select name="area" id="" style="width: 400px;"> 
                                    <?php
                                        while ($row1 = mysqli_fetch_assoc($result1)) {
                                            $city = $row1['area']; 
                                            echo '<option value="'.$city.'">'.$city.'</option>';
                                        }
                                    ?>

                                </select>
            </div>
            <div class="form-group" style="width: 300px;">
                <label for="user">Choose Your Thana:</label>
                                    <?php
                                        include_once('../../connect.php'); 
                                        $sql1 = "select distinct thana from location"; 
                                        $result1 = mysqli_query($con, $sql1); 
                                    ?>
                                <select name="thana" id="" style="width: 400px;"> 
                                    <?php
                                        while ($row1 = mysqli_fetch_assoc($result1)) {
                                            $city = $row1['thana']; 
                                            echo '<option value="'.$city.'">'.$city.'</option>';
                                        }
                                    ?>

                                </select>
            </div>        

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="container my-6">
                <table class="table" >
        <thead>
            <tr>
                <th scope="col" style="text-align: center;">Building Name</th>
                <th scope="col" style="text-align: center;">Holding Number</th>
                <th scope="col" style="text-align: center;">Apartment ID</th>
                <th scope="col" style="text-align: center;">Rent per Month</th>
                <th scope="col" style="text-align: center;">Size</th>
                <th scope="col" style="text-align: center;">BHK</th>
                <th scope="col" style="text-align: center;">Location</th>
                <th scope="col" style="text-align: center;">Action</th>
                
            </tr>
            </thead>
            <tbody>
                <?php 
                while ($row = mysqli_fetch_assoc($requltLO)) {
                    $name = $row['buildingName']; 
                    $hld = $row['holdingNumber']; 
                    $aid = $row['ApartmentID']; 
                    $rpm = $row['rentpermonth']; 
                    $size = $row['size'];
                    $bhk = $row['BHK'];  
                    $location = $row['area'] . ', ' . $row['thana'] . ', ' . $row['city']; 
                    echo '<tr>
                        <td style="text-align: center;">'.$name.'</td>
                        
                        <td style="text-align: center;">'.$hld.'</td>
                        
                        <td style="text-align: center;">'.$aid.'</td>
                        
                        <td style="text-align: center;">'.$rpm.'</td>
                        
                        <td style="text-align: center;">'.$size.'</td>
                        
                        <td style="text-align: center;">'.$bhk.'</td>
                        
                        <td style="text-align: center;">'.$location.'</td>

                        <td style="text-align: center;"><a href="#"><button class="btn btn-success">Apply</button></a></td>
                        
                    </tr>';
                }
                ?>
                </tbody>
         </table>
        </div>
            </body>
    
</html>