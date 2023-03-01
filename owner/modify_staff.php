<?php 
    include_once('../connect.php'); 
    if (isset($_GET['id'])) {
        $staffid = $_GET['id']; 
        $sql = "SELECT * from `staff` where staffid = '$staffid'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        $name = $row['name']; 
        $phone = $row['phone']; 
        $date = $row['joining_date']; 
        $image = $row['image'];
        $hld = $row['holdingNumber'];
        if (isset($_GET['verdict'])) {
            if ($_GET['verdict'] == 'update') {
                $readonly = 0;
                if (isset($_POST['update'])) {
                    $name = $_POST['name']; 
                    $phone = $_POST['phone']; 
                    $date = $_POST['date']; 
                    $image = $_FILES['image'];

                    $filename = explode('.', $image['name']); 
                    $extensions = array('jpeg', 'jpg', 'png');
                    if (in_array(strtolower($filename[1]), $extensions)) {
                        $upload_image = '../images/staff/'. $staffid . '.' . $filename[1];
                        move_uploaded_file($image['tmp_name'], $upload_image);
                    }

                    $sql = "UPDATE staff set 
                                name = '$name', phone = '$phone', joining_date = '$date' 
                                where staffid = '$staffid'";
                    mysqli_query($con, $sql);
                    $up = 'update';
                    header('Location: view_staff.php?id='.$hld.'&stuff_up=1');
                }
            }
            if ($_GET['verdict'] == 'delete') {
                $readonly = 1;
                if (isset($_POST['delete'])) {
                    $sql = "DELETE from staff where staffid = '$staffid'"; 
                    mysqli_query($con, $sql);
                    header('Location: view_staff.php?id='.$hld.'&stuff_del=1');
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

    <title><?php echo $_GET['verdict'] ?> staff</title>
    </head>
    <body>
        <?php 
            require_once('../home/_nav_from_show_building_info.php');
        ?>
        <div class="container my -5" style="width: 30%;"> 

        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
            <label>Name</label>
            <input type="text" name="name"  class="form-control" value="<?php echo $name; ?>" <?php  if ($readonly) echo 'readonly';?>>
            
            </div>
            <div class="form-group">
            <label>Phone</label>
            <input name = "phone" type="number" class="form-control" value="<?php echo $phone; ?>" <?php  if ($readonly) echo 'readonly';?>>
            </div>
            <div class="form-group">
            <label>Joining Date</label>
            <input  name = "date" type="date"  class="form-control" value="<?php echo $date; ?>" <?php  if ($readonly) echo 'readonly';?>>
            </div>
            <div class="form-group">
            <label>Image</label>
            <img  src = "../images/<?php echo $image; ?>" style="width: 100px;">
            <?php 
                if (!$readonly) 
                    echo '<input  name = "image" type="file" accept=".jpg, .jpeg, .png"  class="form-control">';
            ?>
            </div>
            <?php 
                if ($readonly) 
                    echo '<button type="submit" name="delete" class="btn btn-danger">Delete</button>';
                else 
                    echo '<button type="submit" name="update" class="btn btn-primary">Update</button>';
            ?>
        </form>

        </div>

    
    </body>
</html>
