<?php 
    session_start(); 
    include_once('../connect.php'); 
    include_once('../functions.php');
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email']; 
        if (!empty($email)) {
            if (isset($_GET['hld'])) {
                $hld = $_GET['hld'];
                $month = $_GET['month'];
                $sql = "SELECT * from payment_history where ApartmentID LIKE '$hld-%' and 
                                                    ApartmentID = ANY (SELECT ApartmentID from `apartment` 
                                                        where availability=0) and rent_of='$month'";
                $resultq = mysqli_query($con, $sql); 
                $month_name =  date("F", strtotime($month));
                $year = explode('-', $month);
            
        
        

                $html = '<!DOCTYPE html>
                <html>
                <head>
                <title>My Table</title>
                <style>
                    table {
                        border-collapse: collapse;
                        width: 80%;
                        margin: auto;
                    }
                    
                    th, td {
                        border: 1px solid black;
                        padding: 8px;
                        text-align: left;
                    }
                    
                    th {
                        background-color: #dddddd;
                    }
                </style>
                </head>';
                $sql = "SELECT buildingName from building where holdingNumber='$hld' limit 1";
                $result = mysqli_query($con, $sql);
                $row = mysqli_fetch_assoc($result);
                $bname = $row['buildingName'];

                $html = $html . '<h2 style="text-align:center;">Rent Statement for '.$bname.' of '.$month_name.', '.$year[0].'</h2>';

                if (mysqli_num_rows($resultq)) {
                $html = $html . ' <body> <div class="container" style="text-align: center;"><table class="table">
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


                    $html = $html . '
                        <tr> 
                            <td style="text-align: center;"> '.$aid.' </td>
                            <td style="text-align: center;"> '.$name.' </td>
                            <td style="text-align: center;"> '.$month_name.' '.$year[0].'</td>
                            <td style="text-align: center;"> '.$amount.' </td>
                            <td style="text-align: center;"> '.$paid_date.' </td>
                            <td style="text-align: center;"> '.$type.' </td>
                            <td style="text-align: center;"> '.$tnxid.' </td>
                            <td style="text-align: center;"> '.$verified_by.' </td>
                            </tr>'; 
                }

                $sql = "SELECT  SUM(amount) as total from `payment_history` where ApartmentId LIKE '$hld-%' and rent_of = '$month'";
                    $result = mysqli_query($con, $sql); 
                    $row = mysqli_fetch_assoc($result);
                    $total = $row['total'];
                    $html = $html . '<tr><td></td><td></td><td></td><td style="text-align:center;">Total = '.$total.'</td><td></td><td></td><td></td><td></td></tr>';

                $html = $html . '</tbody>
                </table></div></body>';
                create_pdf($html);
                }
            }
        }
    }
?>
