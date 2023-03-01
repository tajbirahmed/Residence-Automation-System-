<?php
    session_start();
    include_once('../connect.php');
    require_once('../home/_nav_from_show_building_info.php');
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email']; 
        $sql = "SELECT holdingNumber from `own` where email='$email'"; 
        $result = mysqli_query($con, $sql);
        echo '<div class="container" style="width: 40%;"><table class="table">
        <thead>
          <tr>
            <th scope="col">Request From</th>
            <th scope="col">Email</th>
            <th scope="col">Request For</th>
            <th scope="col">Action</th>
          </tr>
        </thead>';
        while ($row = mysqli_fetch_assoc($result)) {
            $holding = $row['holdingNumber'];
            $sql_test = "SELECT * from `ownership_request` where holdingNumber = '$holding' and status = 0";
            $result_test = mysqli_query($con, $sql_test);
            while ($row_temp = mysqli_fetch_assoc($result_test)) {
                $temp_email = $row_temp['email'];
                $sql_owner = "SELECT first_name, last_name from owner where email='$temp_email' limit 1";
                $result_owner = mysqli_query($con, $sql_owner);
                $row_owner = mysqli_fetch_assoc($result_owner); 
                $name = $row_owner['first_name'] . ' ' . $row_owner['last_name'];
                echo '<tr>
                        <td>'.$name.'</td>
                        <td>'.$temp_email.'</td>
                        <td>'.$holding.'</td>
                        <td><a href="request_process.php?email='.$temp_email.'&holding='.$holding.'&status=1"><button class="btn btn-success">Accept</button></a>
                        <a href="request_process.php?email='.$temp_email.'&holding='.$holding.'&status=0"><button class="btn btn-danger">Reject</button></a></td>
                      <tr>';
            } 
        
        }
        echo '</table></div>';
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

        <title>Ownership Requests</title>
    </head>
    <body>
    <?php ?>
    </body>
</html>