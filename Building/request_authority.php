<?php 
    session_start(); 
    include_once('../connect.php'); 
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email']; 
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

        <title>Request Ownership</title>
    </head>
    <body>
        <?php require_once('../home/_nav_from_show_building_info.php');?>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Holding Number</th>
                        <th scope="col">Building Name</th>
                        <th scope="col">Location</th>
                        <th>Current Owner</th>
                        <th>Current Owner's Email</th>
                        <th>Action</th>    
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php 
                            $sql =  "SELECT * from `building`"; 
                            $result = mysqli_query($con, $sql); 
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<tr>';
                                    $hld = $row['holdingNumber']; 
                                    $bname = $row['buildingName']; 
                                    echo '<td>'.$hld.'</td>
                                          <td>'.$bname.'</td>';
                                    $sql_loc = "SELECT * from `location` where holdingNumber = '$hld'";
                                    $result_loc = mysqli_query($con, $sql_loc);
                                    if ($result_loc){
                                        $row_loc = mysqli_fetch_assoc($result_loc);
                                        $hno = $row_loc['houseNo'];
                                        $street = $row_loc['street']; 
                                        $block = $row_loc['block'];
                                        $area = $row_loc['area'];
                                        $thana = $row_loc['thana'];
                                        $city = $row_loc['city'];
                                        $location = "House No. $hno, Road No. $street, Block $block, $area, $thana , $city";
                                    }
                                    echo '<td>'.$location.'</td>';
                                    $sql_ow = "SELECT * from `own` NATURAL JOIN `owner` where holdingNumber='$hld'";
                                    $result_ow = mysqli_query($con, $sql_ow);

                                    if ($result_ow) {
                                        $result_temp = $result_ow; 
                                        echo '<td>';
                                        while ($row_ow = mysqli_fetch_assoc($result_ow)) {
                                            $name = $row_ow['first_name'] . ' ' . $row_ow['last_name'];
                                            echo $name . '<br>';
                                        }
                                        echo '</td>';
                                    }
                                    $sql_ow = "SELECT * from `own` NATURAL JOIN `owner` where holdingNumber='$hld'";
                                    $result_ow = mysqli_query($con, $sql_ow);

                                    if ($result_ow) {
                                        echo '<td>';
                                        while ($row_ow = mysqli_fetch_assoc($result_ow)) {
                                            echo $row_ow['email'] . '<br>';
                                        }
                                        echo '</td>';
                                    }
                                    $sql_verify = "SELECT * from `own` where holdingNumber = '$hld' and holdingNumber != ALL 
                                                (SELECT holdingNumber from `own` where email = '$email');";
                                    $result_verify = mysqli_query($con, $sql_verify); 
                                    if (mysqli_num_rows($result_verify)){
                                        echo '<td><a href="request_verify.php?holding='.$hld.'"><button class="btn btn-primary">Request Ownership</button></a></td>';
                                    }
                                    echo '</tr>';
                                }
                            }
                        ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
