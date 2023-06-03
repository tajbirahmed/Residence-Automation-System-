<?php 
    session_start(); 
    include_once('../connect.php');
    include_once('../functions.php');
    if (isset($_SESSION['email']) && isset($_SESSION['type']) && 
    $_SESSION['type'] == 'owner') {
        $sender_email = $_SESSION['email'];
        $sql = "SELECT first_name, last_name from owner where email = '$sender_email' limit 1";
        $result = mysqli_query($con, $sql); 
        if ($result) {
            $row = mysqli_fetch_assoc($result); 
            $sender_name = $row['first_name'] . ' ' . $row['last_name'];
        }
        if (isset($_GET['aid']) && isset($_GET['month'])) {
            $aid = $_GET['aid'];
            $month = $_GET['month'];
            $sql = "SELECT * from tenant where ApartmentID = '$aid' limit 1"; 
            $result = mysqli_query($con, $sql); 
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $recipients = (array) null;
                array_push($recipients, $row['email']);
                $subject = "Rent Payment Reminder";
                $tname = $row['first_name'] . ' ' . $row['last_name'];
                $month_name =  date("F", strtotime($month));
                $year = explode('-', $month);
                $body = "Dear $tname, <br><br>

I hope this message finds you well. I wanted to remind 
you that the rent for the month of $month_name $year[0] was due on 10 $month_name, $year[0]. 
As of today, the payment has not been received. <br><br>

I understand that unexpected situations can happen, but it is important that we work together
to ensure timely payment of rent to avoid any unnecessary late fees or legal issues. <br><br>

Please let me know if there is any issue with the payment, and we can work together to find 
a solution. <br><br>

Thank you for your cooperation.<br><br>

Best regards, <br><br>
                
$sender_name";
                if (isset($_POST['submit'])) {
                    send_mail($sender_name, $sender_email, $recipients, $subject, $body);
                    header('Location: payment_statement.php');
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

        <title>Mail Confirmation</title>
    </head>
    <body>
        <div class="container" style="width:70%;">
        <form method = "post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleInputEmail1">Subject</label>
                    <input type="text" readonly value = "<?php echo $subject; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Messege</label>
                    <textarea readonly class="form-control" rows="20"><?php echo $body; ?></textarea>
                </div>
                <button type="submit" name = "submit" class="btn btn-success">Send Mail</button>
        </form>
        </div>
    </body>
</html>
