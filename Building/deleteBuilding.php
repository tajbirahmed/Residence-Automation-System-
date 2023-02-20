<?php 
include_once('../connect.php'); 
    if (isset($_GET['hld'])) {
        $hld = $_GET['hld']; 
        if (!empty($hld)) {
             
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    <title>Deleting Building <?php echo $hld;?></title>
    </head>
    <body>
        <div class="container" style="text-align: center; width: 50%"> 
            <form>
                <div class="form-group">
                    <label for="exampleInputEmail1">Holding</label>
                    <input type="text" class="form-control" value="<?php echo $hld; ?>" aria-describedby="emailHelp">
                </div>
                <button type="submit" class="btn btn-danger">Submit</button>
            </form>
        </div>
    </body>
</html>
