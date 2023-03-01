<?php 
    session_start(); 
    include_once('../connect.php'); 
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];   
        if (isset($_GET['hld'])) {
            $hld = $_GET['hld']; 
            if (isset($_POST['submit'])) {
                $name = $_POST['name']; 
                $date = $_POST['date']; 
                $amount = $_POST['amount'];
                $desc = $_POST['desc'];
                $sql = "INSERT INTO `expense` (`holdingNumber`, `date`, `paid_by`, `amount`, `description`) 
                                        VALUES ('$hld', '$date', '$name', '$amount', '$desc')"; 
                $result = mysqli_query($con, $sql);
                if ($result)  {
                    header('Location: view_expense.php?hld='.$hld.'&id=1');
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

        <title>Add Expense</title>
    </head>
    <body>
        <?php require_once('../home/_nav_from_show_building_info.php'); ?>
        <div class="container my-5" style="width: 30%;"> 
            <form method="post">
                
                <div class="form-group">
                    <label for="exampleInputEmail1">Paid By</label>
                    <div class="form-outline mb-4">
                            <label for="user">Choose Your Name:</label>
                            <select  required  name="name" class="form-control"> 
                                <option value="none" selected disabled hidden>Select You Name</option>
                                <?php 
                                    echo $hld;
                                    $sql = "CALL get_owners($hld)"; 
                                    $result = mysqli_query($con, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $name = $row['first_name'] . ' ' . $row['last_name'];
                                        echo '<option value="'.$name.'">'.$name.'</option>';
                                    }
                                ?>
                            </select>
                    </div> 
                </div>
                
                <div class="form-group">
                    <label >Date</label>
                    <input  required type="date" name="date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                </div>
                
                <div class="form-group">
                    <label >Description</label>
                    <input  required type="text" name="desc" class="form-control">
                </div>

                <div class="form-group">
                    <label >Amount</label>
                    <input  required type="number" name="amount" class="form-control">
                </div>
                

                <button type="submit" name="submit" class="btn btn-success">Submit</button>
                </form>
        </div>

    </body>
</html>
