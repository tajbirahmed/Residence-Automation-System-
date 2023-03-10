<?php
session_start();
    // What this file is doing? 
    // When clicking on a card in index page 
    // this file is responsible for showing the information aobut 
    // owner and Apartments of the building that was clicked
    // there is a view button for each apartment and 
    // any user can apply to an empty apartment
    // that is beside any empty apartment there should be an apply button. 
    // And also any building owner can't apply to a building to reduce cmplexity.
    include_once('connect.php');
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"> 

    <title>Display Building <?php echo $id;?></title>
  </head>
  <body>
    <?php
        require_once('home/_nav.php');
    ?>
    <div class="container">
    <table class="table">
        <thead> 
                <tr>  
                    <th colspan="5" style="text-align:center">Owner</th>
                </tr>
                <tr>
                    <th scope="col"  style="text-align: center;">First Name</th>
                    <th scope="col"  style="text-align: center;">Last Name </th>
                    <th scope="col"  style="text-align: center;">Phone </th>
                    <th scope="col"  style="text-align: center;">Email</th>
                    <th scope="col"  style="text-align: center;">Image </th>
                    <?php 
                        if (isset($_SESSION['email']) && isset($_SESSION['type'])) {
                            if ($_SESSION['type'] == 'admin') {
                                echo '<th scope="col">Action</th>';
                            }
                        }
                    ?>
                </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_GET['id'])) {
                //$id = $_GET['id'];
                $sql = "select * from `owner` where email= ANY (SELECT email from own where holdingNumber = $id)";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row) {
                            $fname = $row['first_name'];
                            $lname = $row['last_name'];
                            $phn = $row['phone'];
                            $email = $row['email'];
                            $img = $row['image'];
                            
                            echo '<tr>
                            <td style="text-align: center;">' . $fname . '</td>
                            <td style="text-align: center;">' . $lname . '</td>
                            <td style="text-align: center;">' . $phn . '</td>
                            <td style="text-align: center;">' . $email . '</td>
                            <td style="text-align: center;"> <img src="images/'.$img.'" alt="slow connection" width="100px"></td>';
                            
                            
                            if (isset($_SESSION['email']) && isset($_SESSION['type'])) {
                                if ($_SESSION['type'] == 'admin') {
                                     echo '<td><a href="delete_owner.php?hld='.$id.'&email='.$email.'"><button class="btn btn-danger">Delete Owner</button></a></td>';
                                }
                            }
            
                            
                            echo '</tr>';
                            
                        }
                    }
                }
            }
            ?>
        </tbody>
    </table>
    </div>
    <div class="container my-5" >
    <table class="table">
        <thead> 
                <tr>  
                    <th colspan="7  style="text-align: center;"" style="text-align:center">Location</th>
                </tr>
                <tr>
                    <th scope="col" style="text-align: center;">City</th>
                    <th scope="col" style="text-align: center;">Thana </th>
                    <th scope="col" style="text-align: center;">Area</th>
                    <th scope="col" style="text-align: center;">Block</th>
                    <th scope="col" style="text-align: center;">Street No.</th>
                    <th scope="col" style="text-align: center;">House No.</th>
                    <th scope="col" style="text-align: center;">Google Map</th>
                </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "select * from `location` where holdingNumber=$id";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    if ($row) {
                            $city = $row['city'];
                        $thana = $row['thana'];
                        $area = $row['area'];
                        $block = $row['block'];
                        $strt = $row['street'];
                        $house = $row['houseNo'];
                        $gmap = $row['google_map_location'];
                            echo ' 
                            <td style="text-align: center;">'.$city.'</td>
                            <td style="text-align: center;">'.$thana.'</div></td>
                            <td style="text-align: center;">'.$area.'</div></td>
                            <td style="text-align: center;">'.$block.'</div></td>
                            <td style="text-align: center;">'.$strt.'</div></td>
                            <td style="text-align: center;">'.$house.'</div></td>
                            <td style="text-align: center;"><a href="'.$gmap.'"><button class="btn btn-primary">Map</button></a></td>

                            </tr>';
                    }
                }
            }
            ?>
        </tbody>
        </table>
    </div>
    <div class="container my-5">
    <table class="table">
        <thead>
                <tr>  
                    <th colspan="4" style="text-align:center">Apartments</th>
                </tr>
                <tr>
                    <th scope="col" style="text-align: center;">Apartment ID</th>
                    <th scope="col" style="text-align: center;">Size </th>
                    <th scope="col" style="text-align: center;">Rent per Month</th>
                    <th scope="col" style="text-align: center;">Availability</th>
                    <th scope="col" style="text-align: center;">Actions</th>
                    <th scope="col" style="text-align: center;">Apply</th>
                    
                </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                
                $sql = "select * from `apartment` where holdingNumber=$id";
                $result=mysqli_query($con, $sql);
                if ($result) {
                    
                    while ($row=mysqli_fetch_assoc($result)) {
                        $aID=$row['ApartmentID'];
                        $size=$row['size'];
                        $rpdn=$row['rentpermonth'];
                        $avl=$row['availability'] ? "YES" : "NO";
                        
                        
                                 
                        

                        echo '<tr>
                                <td style="text-align: center;">'.$aID.'</td>
                                <td style="text-align: center;">'.$size.'</td>
                                <td style="text-align: center;">'.$rpdn.'</td>
                                <td style="text-align: center;">'.$avl.'</td>
                                <td style="text-align: center;"><a href="Building/Apartments/view_apartment.php?aid='.$aID.'">
                                    <button class="btn btn-primary">View</button></a></td>';
                        // Changed the condition that an owner/ tenant can't apply to any 
                        // available building.
                        // ~~Not verified~~
                        if ($row['availability'] && !isset($_SESSION['email'])) {
                            echo '<td style="text-align: center;">
                            <a href="Building/Apartments/apply_request.php?aid='.$aID.'" target"_blank">
                                <button class="btn btn-success">Apply</button></a></td>';
                        } else 
                            echo '<td></td>';
                        echo '</tr>';
                        
                        
                    } 
                    
                } 
            } 
            ?>
            
  
    </tbody>
        </table>
    </div>
 </body>
</html>
