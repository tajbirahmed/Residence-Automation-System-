<?php 
    session_start();
    include_once('../../connect.php');
    include_once('../../functions.php'); 
    
    if ($_GET['aid']) {
        $aid = $_GET['aid'];
        $temp_hld = explode('-', $aid); 
        $hld = $temp_hld[0];
        $sql = "SELECT email from `own` where holdingNumber = '$hld'";
        $result = mysqli_query($con, $sql);
        $recipients = (array) null;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($recipients, $row['email']);
        }
        $sql = "SELECT buildingName from `building` where holdingNumber = '$hld'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        $bname = $row['buildingName'];
    }
    if (isset($_POST['submit'])) {
        if (isset($_POST['sender_email']) && isset($_POST['sub']) && isset($_POST['body'])) {
            $sender_name = $_POST['sender']; 
            $sender_email = $_POST['sender_email']; 
            $subject = $_POST['sub']; 
            $body = $_POST['body'];
            
            
            send_mail($sender_name, $sender_email, $recipients, $subject, $body); 
            header('Location: view_apartment.php?aid='.$aid.'&id=1');
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Email Sender</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php 
        require_once('../../home/_nav_from_aparmtent_view.php'); 
        
    ?>
    <h3 style="text-align: center;"> You are applying to Apartment <?php  echo $aid;?> of <?php echo $bname; ?></h3>
    <div class="container my-5" style="width: 50%;">
        <form method="post" enctype="multipart/form-data">
            
            <div class="form-group">
                <label>Email</label>
                <input required type="email" name="sender_email" class="form-control" placeholder="Enter you email*">
            </div>
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="sender" class="form-control" placeholder="Enter you name">
            </div>
            <div class="form-group">
                <label>Subject</label>
                <input type="text" required name="sub" class="form-control" readonly value="About renting your apartment <?php echo $aid; ?> from <?php echo $bname; ?>">
            </div>
            
            <div class="form-group">
                <label>Messege</label>
                <textarea class="form-control" required id="body" name="body" placeholder="Provide all details including contact information." rows="5" required></textarea>
            </div>
                
            <?php
                if (!isset($_SESSION['email'])) { 
                    echo '<button type="submit" name="submit" class="btn btn-primary">Send Mail</button>';
                }
            ?>
            </form>
        </div>

  <!-- Bootstrap Js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
