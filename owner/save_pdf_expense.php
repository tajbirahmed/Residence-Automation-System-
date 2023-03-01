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
                $sql = "SELECT * from expense where date like '$month-%' and holdingNumber=$hld";
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
                        width: 100%;
                    }
                    
                    th, td {
                        border: 1px solid black;
                        padding: 8px;
                        text-align: center;
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

                $html = $html . '<h2 style="text-align:center;">Expenses for '.$bname.' of '.$month_name.', '.$year[0].'</h2>';

                if (mysqli_num_rows($resultq)) {
                $html = $html . ' <body>
                <div class="container my-5" style="text-align:center;">
                    <table class="table center">
                        <thead>
                            <tr>
                            <th scope="col" style="text-align: center;">Paid By</th>
                            <th scope="col" style="text-align: center;">Date</th>
                            <th scope="col" style="text-align: center;">Description</th>
                            <th scope="col" style="text-align: center;">Amount</th>
                            </tr>
                        </thead>
                        <tbody>';



                while ($row = mysqli_fetch_assoc($resultq)) {
                    $paid_by = $row['paid_by']; 
                    $date = $row['date']; 
                    $amount = $row['amount']; 
                    $desc = $row['description'];


                    $html = $html . '
                                        <tr>
                                        <td style="text-align: center;">'.$paid_by.'</td>
                                        <td style="text-align: center;">'.$date.'</td>
                                        <td style="text-align: center;">'.$desc.'</td>
                                        <td style="text-align: center;">'.$amount.'</td>
                                        </tr>'; 
                }

                $sql = "SELECT  SUM(amount) as total from `expense` where holdingNumber = $hld and date like '$month-%'";
                $result = mysqli_query($con, $sql); 
                $row = mysqli_fetch_assoc($result);
                $total = $row['total'];
                $html = $html . '<tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align:center;">Total = '.$total.'</td>
                                    </tr>';

                $html = $html . '</tbody>
                </table></div></body>';
                create_pdf($html);
                }
            }
        }
    }
?>
