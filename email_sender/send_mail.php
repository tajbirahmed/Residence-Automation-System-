<?php 
    session_start(); 
    include_once('../functions.php');
    include('../connect.php'); 
    if (isset($_GET['id'])) {
        $hld = $_GET['id'];

    }
    if (isset($_POST['submit'])) {
        $sender = $_SESSION['email']; 
        $sql = "SELECT first_name, last_name from owner where email='$sender'"; 
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result); 
        $name = $row['first_name'] . ' ' . $row['last_name']; 
        $receipent_email = (array) null; 
        if (isset($_POST['all'])) {
            $sql = "SELECT email from tenant where ApartmentID LIKE '$hld-%'"; 
            $result = mysqli_query($con, $sql); 
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($receipent_email, $row['email']);
            }
            
        }
        else if (isset($_POST['email'])) {
            $receipent_email = $_POST['email'];
        }
        if (isset($_POST['sub']) && isset($_POST['body'])) {
            $subject = $_POST['sub'];
            $body = $_POST['body'];
        }
        send_mail($name, $sender, $receipent_email, $subject, $body); 
        header('Location: ../ownerInterface.php?send_mail=1');
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>Email Sent</title>
        </head>
    <body>
        <div class="container">
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Subject</label>
                <input type="text" name="sub" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter subject of your notification">
            </div>
            <div class="form-group">
                <label>Messege</label>
                <textarea class="form-control" id="body" name="body" placeholder="Provide all details including." rows="5" required></textarea>
            </div>
                <fieldset name="checkbox">
                    <legend>Choose your desired recipient(s)</legend>

                        <div>
                            <table>
                                <thead>
                                    <th>Select</th>
                                    <th> ApartmentID</th>
                                    <th> Name</th>
                                    <th> Image</th>
                                </thead>
                                <tbody> <tr>
                                <td><input type="checkbox" value="all" name="all"></td>
                                <td>Send to all.</td>
                                <td></td>
                                <td><img src="" style="width: 90px;"/></td>
                                
                                </tr>
                                <?php 
                                    $sql = "SELECT * from tenant where ApartmentID LIKE '$hld-%'"; 

                                    $result = mysqli_query($con, $sql); 
                                    if ($result) {
                                        while($row = mysqli_fetch_assoc($result)) {
                                            $aid = $row['ApartmentID']; 
                                            $email = $row['email']; 
                                            $name = $row['first_name'] . ' ' . $row['last_name'];
                                            $img = $row['image']; 
                                            
                                            echo '<tr><td><input type="checkbox" value = "'.$email.'" name="email[]"></td>';
                                            echo '<td>'.$aid.'</td>
                                                <td>'.$name.'</td>
                                                <td><img src="../images/'.$img.'" style="width:90px;"/></td>    
                                            </tr>';
                                        }
                                    }
                                ?>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        
                </fieldset>
            
        <button type="submit" name="submit" class="btn btn-primary">Send</button>
        </form>
        </div>

    </body>
</html>