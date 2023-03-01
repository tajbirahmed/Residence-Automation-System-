<?php
    session_start(); 
    include_once('../connect.php'); 
    
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>Expanse Statement</title>
    </head>
    <body>
        <?php require_once('../home/_nav_from_show_building_info.php'); ?>
        <div class="container my-5" style="width: 60%;">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Paid By</th>
                    <th scope="col">Date</th>
                    <th scope="col">Description</th>
                    <th scope="col">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if (isset($_POST['submit'])) {
                            $month = $_POST['date']; 
                            $hld = $_POST['holding']; 
                            $sql = "SELECT * from expense where date like '$month-%' and holdingNumber=$hld";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $paid_by = $row['paid_by']; 
                                $date = $row['date']; 
                                $amount = $row['amount']; 
                                $desc = $row['description'];
                                echo '<tr>
                                        <td>'.$paid_by.'</td>
                                        <td>'.$date.'</td>
                                        <td>'.$desc.'</td>
                                        <td>'.$amount.'</td>
                                        </tr>';
                            } 
                        }
                        
                    ?>
                </tbody>
            </table>
            <a href="save_pdf_expense.php?hld=<?php echo $hld;?>&month=<?php echo $month;?>" target="_blank"><button class="btn btn-success">Download Pdf</button></a>
        </div>

    </body>
</html>
