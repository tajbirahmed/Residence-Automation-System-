<?php 
    session_start(); 
    include_once('../connect.php');
    if (isset($_SESSION['email']) && isset($_GET['aid'])) {
        $aid = $_GET['aid'];
        $sql = "SELECT registerddate from tenant where ApartmentID = '$aid'limit 1"; 
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        $start = date_create($row['registerddate']);
        
        $start = date_format($start, 'Y-m');
        $end = date('Y-m');
        $sql = "SELECT * from payment_history where ApartmentID = '$aid' and rent_of >= '$start' 
                    and rent_of <= '$end' order by rent_of desc"; 
        $result = mysqli_query($con, $sql); 
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
        <?php require_once('../home/login_nav.php'); ?>
        <div class="container my-5" style="width: 70%;">
        <?php 
            echo '<h3 style="text-align: center;">Rent history of Apartment '.$aid.' </h3>';
            ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Rent of</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Paid By</th>
                    <th scope="col">Paid At</th>
                    <th scope="col">Medium</th>
                    <th scope="col">Transaction ID</th>
                    <th scope="col">Verfied By</th>
                    <th scope="col">Verfied At</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $rent_of = $row['rent_of']; 
                            $amount = $row['amount'];
                            $name = $row['name']; 
                            $paid_date = $row['paid_date'];
                            $medium = $row['type'];
                            $tnxid = $row['tnx_id'];
                            $verified_by = $row['verified_by']; 
                            $verified_at = $row['verified_at'];
                            $month =  date("F", strtotime($rent_of));
                            $year = explode('-', $rent_of);
                            echo '<tr>
                                    <td>'.$month.' '.$year[0].'</td>
                                    <td>'.$amount.'</td>
                                    <td>'.$name.'</td>
                                    <td>'.$paid_date.' 
                                    </td>
                                    <td>'.$medium.'</td>
                                    <td>'.$tnxid.'</td>
                                    <td>'.$verified_by.'</td>
                                    <td>'.$verified_at.'</td>
                            </tr>';
                        }
                    } else {
                        // query fail
                    }
                ?>  
            </tbody>
        </table>
        </div>
    </body>
</html>