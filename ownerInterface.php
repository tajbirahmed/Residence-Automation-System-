<?php
    // It is the page where an owner redirected to 
    // after successfully logged in 
    // and here is a list of that owner owned 
    // buildings along with a important button Add building
    // with which an owner can add any number of buildings he want.
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    session_start(); 
    include_once('connect.php'); 
    include_once('functions.php'); 
    require_once('home/_nav_from_ownerinterface.php');
    if (isset($_GET['send_mail']) && $_GET['send_mail'] == 1) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Email sent successful.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
    if (isset($_SESSION['type'])) {
         
        if ($_SESSION['type'] == 'owner') {
            $type = 'owner'; 
            
            if (isset($_SESSION['email'])){
                
                $email = $_SESSION['email']; 
                $sql = "select * from own where email='$email' and holdingNumber<>0"; 

                $result = mysqli_query($con, $sql);
                
                if (mysqli_num_rows($result) > 0) {
                     
                    if (mysqli_num_rows($result) > 1)  {
                        echo '<h1 style="text-align: center;"> Your Enlisted Buildings are</h1>';
                    } else {
                        echo '<h1 style="text-align: center;"> Your Enlisted Building is </h1>';
                    }

                    echo '<div class="container">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Building Name</th>
                                    <th scope="col">Holding Number</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>';
                    while ($row = mysqli_fetch_assoc($result)) {
                        
                        $hld = $row['holdingNumber'];
                        $sql1 = "SELECT * from building where holdingNumber=$hld limit 1"; 
                        $result1 = mysqli_query($con, $sql1);
                        $row1 = mysqli_fetch_assoc($result1);
                        $image = $row1['image']; 
                        $update='update';
                        $delete='delete';
                        $month = date('Y-m');
                        echo '<tr>
                                <td>'.$row1['buildingName'].'</td>
                                <td>'.$hld.'</td>
                                <td><img src="images/'.$image.'" style="width: 150px; height: 150px;"></td>
                                <td>
                                    <a href="owner/showbuildinginfo.php?showHolding='.$hld.'"><button class="btn btn-primary">View</button></a>
                                    <a href="Building/modify_building.php?id='.$hld.'&action='.$update.'"><button class="btn btn-success">Update</button></a> <br>
                                    <br>
                                    <a href="Building/modify_building.php?id='.$hld.'&action='.$delete.'"><button class="btn btn-danger">Delete</button></a>
                                    <a href="email_sender/send_mail.php?id='.$hld.'"><button class="btn btn-alert">Notify</button></a> <br>
                                    <br>
                                    <a href="owner/view_staff.php?id='.$hld.'"><button class="btn btn-primary">View Staffs</button></a> 
                                    <a href="payment/financial_report.php?hld='.$hld.'&month='.$month.'" target="_blank"><button class="btn btn-dark">Financial Report</button></a> <br><br>
                                </td>
                                ';
                    }            



                    echo '</tbody>
                        </table></div>';    

                    

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

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">    
        <title>Building</title>
    </head>
    <body>
        <?php 
            
        ?>
        <div class="container my-5" style="text-align: 20%">
            <h1>Actions</h1>
            <a href="Building/addbuilding.php?id=<?php echo $email; ?>"><button class="btn btn-success">Add New Building</button>
            <a href="Building/request_authority.php"><button class="btn btn-info">Request Ownership</button>
            <a href="Building/view_request.php"><button class="btn btn-info">Ownership Requests</button>
            
        </div>
    </body>
