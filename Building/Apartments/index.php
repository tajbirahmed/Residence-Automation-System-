<?php 
    session_start();
    include_once('../../connect.php'); 
    $city = "none"; 
    $thana = "none"; 
    $area = "none"; 
    $min = 0; 
    $max = 100000; 
    $bhk = -1; 
    $floor = -1;
    
    if (isset($_POST['submit'])) {
        if (!empty($_POST['bhk'])) {
            $bhk = $_POST['bhk'];
        }
        if (!empty($_POST['size'])) {
            $size = $_POST['size'];
        }
        if (!empty($_POST['floor'])) {
            $floor = $_POST['floor'];
        }
        if (!empty($_POST['min_rent'])) {
            $min = $_POST['min_rent'];
        }
        if (!empty($_POST['max_rent'])) {
            $max = $_POST['max_rent'];
        }
        if (isset($_POST['city']) && $_POST['city'] != 'none') {
            $city = $_POST['city']; 
        }
        if (isset($_POST['thana']) && $_POST['thana'] != 'none') {
            $thana = $_POST['thana'];
            $city = "none"; 
            // echo $_POST['thana'];
        }
        if (isset($_POST['area']) && $_POST['area'] != 'none') {
            $area = $_POST['area'];
            $thana = "none";
            $city = "none"; 
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

    <title>View Available Aprtments</title>
    </head>
    <body>
        <?php require_once('../../home/_nav_from_aparmtent_view.php'); ?>
            <div class="div my-5" style="padding: 10px;display: flex;align-items: center;justify-content: center;width:20%;float: left;">
                <form method="post" action="index.php" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label>BHK</label>
                        <input type="number" class="form-control" name="bhk" value = "<?php if (isset($_POST['submit']) && $bhk != -1) echo $bhk;?>" style="width:40%;">
                    </div>
                    
                    <div class="form-group">
                        <label>Size</label>
                        <input type="number" class="form-control" name="size" value = "<?php if (isset($_POST['submit']) && $size != -1) echo $size;?>" style="width:60%;" placeholder="sq. feet">
                    </div>
                    
                    <div class="form-group">
                        <label>Floor</label>
                        <input type="number" class="form-control" name="floor" value = "<?php if (isset($_POST['submit']) && $floor != -1) echo $floor;?>" style="width:40%;">
                    </div>
                    
                    <div class="form-group">
                        <label>Rent</label>
                        <input type="number" class="form-control" name="min_rent" value = "<?php if (isset($_POST['submit']) && $min != 0) echo $min;?>" style="width:60%;" placeholder="min rent"> <br>
                        <input type="number" class="form-control" name="max_rent" value = "<?php if (isset($_POST['submit']) && $max != 100000) echo $max;?>"style="width:60%;" placeholder="max rent">
                    </div>
                    <div class = "container my-2" >
                        <div class="form-outline">
                                <label>Choose Your City</label>
                                <select name="city" class="form-control"> 
                                    <option value="none" selected disabled hidden> Choose You City</option>
                                
                                
                            <?php 
                                $sql = "SELECT distinct city from location";
                                $result = mysqli_query($con, $sql); 
                                
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $city_sel = $row['city'];
                                    echo '<option value="'.$city_sel.'">'.$city_sel.'</option>';
                                }
                            ?>
                            </select>
                        </div> 
                    </div>
                        <div class="form-outline">
                                <label>Choose Your Thana</label>
                                <select name="thana" class="form-control"> 
                                    <option value="none" selected disabled hidden> Choose You Thana</option>
                                
                                
                            <?php 
                                $sql = "SELECT distinct thana from location";
                                $result = mysqli_query($con, $sql); 
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $thana_sel = $row['thana'];
                                    
                                    echo '<option value="'.$thana_sel.'">'.$thana_sel.'</option>';
                                }
                            ?>
                            </select>
                        </div> 
                        <div class="form-outline">
                                <label>Choose Your Area</label>
                                <select name="area" class="form-control"> 
                                    <option value="none" selected disabled hidden> Choose You Area</option>
                                
                                
                            <?php 
                                $sql = "SELECT distinct area from location";
                                $result = mysqli_query($con, $sql); 
                                
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $area_sel = $row['area'];
                                    echo '<option value="'.$area_sel.'">'.$area_sel.'</option>';
                                }
                            ?>
                            </select>
                        </div> 
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
        </div>
        <div class="container my-5" style="text-align: center;padding: 10px;display: flex;align-items: center;justify-content: center;width:80%;float: left;">
            <table class="table">
                
                <thead>
                    <tr>
                    <th colspan="9"><h3 style="text-align: center">Available Apartments</h3></th>
                </tr>
                <tr>
                    <th scope="col">Holding Number</th>
                    <th scope="col">Building Name</th>
                    <th scope="col">Apartment ID</th>
                    <th scope="col">Rent Per Month</th>
                    <th scope="col">Size</th>
                    <th scope="col">BHK</th>
                    <th scope="col">Floor</th>
                    <th scope="col">Location</th>
                    <th scope="col">Google Map Location</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        
                         $sqlLO = "CALL get_apartment_with_location('$city', '$thana', '$area', $min, $max, $bhk, $floor)"; 
                         $requltLO = mysqli_query($con, $sqlLO); 
                        while ($row = mysqli_fetch_assoc($requltLO)) {
                            echo '<tr>';
                            $aid = $row['ApartmentID']; 
                            $hld = $row['holdingNumber']; 
                            $rpm = $row['rentpermonth']; 
                            $size = $row['size']; 
                            $floor = $row['floor'];
                            $bhk = $row['BHK']; 
                            $bname = $row['buildingName'];
                            $location =  $row['area'] . ', Block ' . $row['block'] . ', Street ' . $row['street'] . ', ' . $row['thana'] . ' ' . $row['city'];  
                            $gloc = $row['google_map_location'];
                            echo '<td>'.$hld.'</td> 
                                    <td>'.$bname.'</td>
                                    <td>'.$aid.'</td>
                                    <td>'.$rpm.'</td> 
                                    <td>'.$size.'</td>
                                    <td>'.$bhk.'</td>
                                    <td>'.$floor.'</td>
                                    <td>'.$location.'</td>
                                    <td><a href="'.$gloc.'" target="_blank"><img src="../../images/Google_Maps_logo.png" style="height:30px; width: 30px;"></a></td>';
                                    echo '<td> 
                                        <a href="view_apartment.php?aid='.$aid.'" target="_blank"><button class="btn btn-primary">View</button></a>
                                        <a href="apply_request.php?aid='.$aid.'" target="_blank"><button class="btn btn-success">Apply</button></a>
                                    </td>';
                                    echo '</tr>';
                        }
                        
                    //?>
                </tbody>
            </table>
        </div>

    </body>
</html>
