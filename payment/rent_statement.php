<?php 
    session_start(); 
    include_once('../connect.php'); 
    include_once('../functions.php');
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email']; 
        if (!empty($email)) {
            if (isset($_POST['submit'])) {
                if (isset($_POST['holding'])) {
                    $hld = $_POST['holding'];
                    $month = $_POST['date'];
                    $sql = "SELECT * from payment_history where ApartmentID LIKE '$hld-%' and 
                                                        ApartmentID = ANY (SELECT ApartmentID from `apartment` 
                                                         where availability=0) and rent_of='$month'";
                    $resultq = mysqli_query($con, $sql); 
                    $month_name =  date("F", strtotime($month));
                    $year = explode('-', $month);
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

        <title>Rent of <?php echo $month_name . ' ' . $year[0];  ?> </title>
    </head>
    <body>
        <?php 
            require_once('../home/_nav_from_show_building_info.php');
        ?>
        <div class="container" style="text-align: center;">
            <?php 
                $sql = "SELECT buildingName from building where holdingNumber='$hld' limit 1";
                $result = mysqli_query($con, $sql);
                $row = mysqli_fetch_assoc($result);
                $bname = $row['buildingName'];
            ?>
            <h2>Rent Statement for <?php echo $bname; ?> of <?php echo $month_name . ' ' . $year[0];  ?> </h2>
                <?php
                if (isset($_POST['submit']) && mysqli_num_rows($resultq)) {
                    echo '<table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center;">ApartmentID</th>
                                    <th scope="col" style="text-align: center;">Name</th>
                                    <th scope="col" style="text-align: center;">Rent of</th>
                                    <th scope="col" style="text-align: center;">Amount</th>
                                    <th scope="col" style="text-align: center;">Paid Date</th>
                                    <th scope="col" style="text-align: center;">Type</th>
                                    <th scope="col" style="text-align: center;">Tnx ID</th>
                                    <th scope="col" style="text-align: center;">Verified By</th>
                                    <th scope="col" style="text-align: center;">Action</th>
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
                        $amount = $row['amount'];
                        $month_name =  date("F", strtotime($month));
                        $year = explode('-', $month);


                        echo '
                            <tr> 
                                <td style="text-align: center;"> '.$aid.' </td>
                                <td style="text-align: center;"> '.$name.' </td>
                                <td style="text-align: center;"> '.$month_name.' '.$year[0].'</td>
                                <td style="text-align: center;"> '.$amount.' </td>
                                <td style="text-align: center;"> '.$paid_date.' </td>
                                <td style="text-align: center;"> '.$type.' </td>
                                <td style="text-align: center;"> '.$tnxid.' </td>
                                <td style="text-align: center;"> '.$verified_by.' </td>';
                                if ($verify == null) {
                                    $acc = 'owner_pay';
                                    echo '<td><a href="payment_verify.php?id='.$acc.'&aid='.$aid.'&rent_of='.$month.'"><button class="btn btn-success">Cash Paid</button></a>'; 
                                }
                                if ($verify == 'payment-not-checked') {
                                    $acc = 'accept';
                                    $rej = 'reject';
                                    echo '<td><a href="payment_verify.php?id='.$acc.'&aid='.$aid.'&rent_of='.$month.'"><button class="btn btn-success">Accept</button></a>'; 
                                    echo ' ';
                                    echo '<a href="payment_verify.php?id='.$rej.'&aid='.$aid.'&rent_of='.$month.'"><button class="btn btn-danger">Reject</button></a></td>';
                                } 
                                
                                echo '<td><a href="tenant_rent_history.php?aid='.$aid.'"><button class="btn btn-primary">View</button></a></td>';
                                //if ($verified_by == 'not verified') { 
                                    echo '<td>
                                        <a href="send_mail_for_rent.php?aid='.$aid.'&month='.$month.'">
                                            <button class="btn btn-primary">Notify</button>
                                        </a>
                                    </td>';
                                    
                                //}
                            echo  '</tr>'; 
                    }
                    $sql = "SELECT  SUM(amount) as total from `payment_history` where ApartmentId LIKE '$hld-%' and rent_of = '$month'";
                    $result = mysqli_query($con, $sql); 
                    $row = mysqli_fetch_assoc($result);
                    $total = $row['total'];
                    echo '<tr><td></td><td></td><td></td><td style="text-align:center;">Total = '.$total.'</td></tr>';
                    echo '</tbody>
                    </table>';
                } else {
                    // no result
                }
                echo '<a href="save_pdf.php?hld='.$hld.'&month='.$month.'" target="_blank"><button class="btn btn-success">Download Pdf</button></a>';
                ?>
                
        </div>
    </body>
</html>