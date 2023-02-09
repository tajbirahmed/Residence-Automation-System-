<?php
    include_once('connect.php');
    
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"> 

    <title>Display</title>
  </head>
  <body>
    <div class="container">
    <table class="table">
        <thead> 
                <tr>  
                    <th colspan="5" style="text-align:center">Owner</th>
                </tr>
                <tr>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name </th>
                    <th scope="col">Phone </th>
                    <th scope="col">Email</th>
                    <th scope="col">Image </th>
                </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "select * from owner where holdingNumber=$id";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row) {
                            $fname = $row['first_name'];
                            $lname = $row['last_name'];
                            $phn = $row['phone'];
                            $email = $row['email'];
                            // $img = $row['houseNo'];
                            
                            echo '<tr>
                            <td>' . $fname . '</td>
                            <td>' . $lname . '</td>
                            <td>' . $phn . '</td>
                            <td>' . $email . '</td>
                            <td> <img src="imageavatar.jpg" alt="slow connection" width="150px"></td>
                            </tr>';
                            
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
                    <th colspan="5" style="text-align:center">Location</th>
                </tr>
                <tr>
                    <th scope="col">City</th>
                    <th scope="col">Thana </th>
                    <th scope="col">Area</th>
                    <th scope="col">Street No.</th>
                    <th scope="col">House No.</th>
                </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "select * from location where holdingNumber=$id";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    if ($row) {
                            $city = $row['city'];
                        $thana = $row['thana'];
                        $area = $row['area'];
                        $strt = $row['street'];
                        $house = $row['houseNo'];
                            echo ' 
                            <td>'.$city.'</td>
                            <td>'.$thana.'</div></td>
                            <td>'.$area.'</div></td>
                            <td>'.$strt.'</div></td>
                            <td>'.$house.'</div></td>
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
                    <th scope="col">Apartment ID</th>
                    <th scope="col">Size </th>
                    <th scope="col">Rent per Month</th>
                    <th scope="col">Availability</th>
                </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                
                $sql = "select * from apartment where holdingNumber=$id";
                $result=mysqli_query($con, $sql);
                if ($result) {
                    
                    while ($row=mysqli_fetch_assoc($result)) {
                        $aID=$row['ApartmentID'];
                        $size=$row['size'];
                        $rpdn=$row['rentpermonth'];
                        $avl=$row['availability'] ? "YES" : "NO";
              
                        echo '  <tr>
                                <td>'.$aID.'</td>
                                <td>'.$size.'</td>
                                <td>'.$rpdn.'</td>
                                <td>'.$avl.'</td>
                                </tr>';
                        
                    } 
                    
                } 
            } 
            ?>
            
  
    </tbody>
        </table>
    </div>
 </body>
</html>
