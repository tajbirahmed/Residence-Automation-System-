<?php 
    session_start(); 
    include_once('../connect.php'); 
    include_once('../functions.php');
    if (isset($_SESSION['email'])) {
        if (isset($_GET['aid']) && isset($_GET['month'])) {
            $aid = $_GET['aid']; $month = $_GET['month']; 

            $sql = "SELECT * from payment_history where ApartmentID='$aid' and rent_of='$month'";
            $result = mysqli_query($con, $sql); 
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $name = $row['name']; 
                $amount = $row['amount'];
                $medium = $row['type'];
                $tnx_id = $row['tnx_id'];
                $verified_by = $row['verified_by'];
                $verified_at = $row['verified_at'];
            }
        }
    }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rent Info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <?php require_once('../home/login_nav.php'); ?>
    <div class="container my-3" style="width: 35%;">
        <form method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Paid By</label>
                <input type="text" readonly value="<?php echo $name; ?>"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Rent of</label>
                <input type="text" readonly class="form-control" value="<?php if (isset($month)) echo month_to_month_name($month); ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Amount</label>
                <input type="text" readonly class="form-control" value="<?php if (isset($amount)) echo $amount; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Medium</label>
                <input type="text" readonly class="form-control" value="<?php if (isset($medium)) echo $medium; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Transaction ID</label>
                <input type="text" readonly class="form-control" value="<?php if (isset($tnx_id)) echo $tnx_id; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Verified By</label>
                <input type="text" readonly class="form-control" value="<?php if (isset($verified_by)) echo $verified_by; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Verified At</label>
                <input type="text" readonly class="form-control" value="<?php if (isset($verified_at)) echo $verified_at; ?>">
            </div>
        </form>
    </div>
</body>
</html>