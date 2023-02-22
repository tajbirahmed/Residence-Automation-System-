<?php 
    session_start(); 
    include_once('../connect.php'); 
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email']; 
        if (!empty($email)) {
            if (isset($_POST['submit'])) {
                if (isset($_POST['holding'])) {
                    $hld = $_POST['holding'];
                    $month = $_POST['date'];
                    $sql = "SELECT * from payment_history where ApartmentID LIKE '$hld-%' and rent_of='$month'";
                    $resultq = mysqli_query($con, $sql); 
                    
                    

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Rent Statement</title>
    </head>
    <body> 
        <?php 
             require_once('../home/_nav_from_show_building_info.php'); 
        ?>
        <div class="container my-4" style="text-align:center; width: 20%;">
            <form method="post" action="payment_statement.php">
            
            <div class="form-group">
                <label for="exampleInputEmail1">Select Month and Year</label>
                <input type="month" name="date" value="<?php echo date('Y-m'); ?>" class="form-control">
            </div>
            
            <div class="form-group">
                <select class="form-control" name="holding" id="plan">
                    <option value="none" selected disabled hidden>Select an Option</option>
                    <?php 
                        $sql = "SELECT * from building NATURAL JOIN own where email='$email'"; 
                        $result = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $bname = $row['buildingName']; 
                            $holding = $row['holdingNumber'];
                            echo '<option value="'.$holding.'">'.$bname.'</option>';
                        }
                    ?>
                </select>
            </div>
                             
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="container">
            <?php 
                if (isset($_POST['submit']) && mysqli_num_rows($resultq)) {
                    echo '<table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ApartmentID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Rent of Month</th>
                                    <th scope="col">Paid Date</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Tnx ID</th>
                                    <th scope="col">Verified By</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>';
                    while ($row = mysqli_fetch_assoc($resultq)) {
                        $aid = $row['ApartmentID']; 
                        //$tempaid = explode('-', $tempaid);
                        //$aid = $tempaid[1]; 
                        $name = $row['name']; 
                        $paid_date = $row['paid_date'];
                        $verify = $row['verify']; 
                        $type = $row['type']; 
                        $tnxid = $row['tnx_id']; 
                        $verified_by = $row['verified_by']; 
                        
                        echo '
                            <tr> 
                                <td> '.$aid.' </td>
                                <td> '.$name.' </td>
                                <td> '.$month.' </td>
                                <td> '.$paid_date.' </td>
                                <td> '.$type.' </td>
                                <td> '.$tnxid.' </td>
                                <td> '.$verified_by.' </td>';
                                if ($verified_by == 'not verified') {
                                    $acc = 'accept';
                                    $rej = 'reject';
                                    echo '<td><a href="payment_verify.php?id='.$acc.'&aid='.$aid.'&rent_of='.$month.'"><button class="btn btn-success">Accept</button></a>  
                                              <a href="payment_verify.php?id='.$rej.'&aid='.$aid.'&rent_of='.$month.'"><button class="btn btn-danger">Reject</button></a></td>';
                                } else {
                                    echo '<td><a href="#"><button class="btn btn-primary">View</button></a></td>';
                                }
                           echo  '</tr>'; 
                    }
                    echo '</tbody>
                    </table>';
                } else {
                    // no result
                }
                        
            ?>
        </div>

    </body>
</html>