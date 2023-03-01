<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="../../index.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <?php  
            if (!isset($_SESSION['email'])) {
              
              echo '<li class="nav-item active">
        <a class="nav-link" href="../../ProfileSystem/login.php">Login <span class="sr-only">(current)</span></a>
      </li>
       <li class="nav-item">
              <a class="nav-link" href="../../ProfileSystem/signup.php">Sign Up</a>
              </li>';
            }
        ?>
      <?php
      
               if (isset($_SESSION['email']) && isset($_SESSION['type'])) {
                 echo '<li class="nav-item active">
                  <a class="nav-link" href="../../ProfileSystem/logout.php">Logout</a>
                </li>';
               }
               if (isset($_SESSION['email']) && $_SESSION['type'] == 'owner') {
                echo '<li class="nav-item active">
                <a class="nav-link" href="../../ownerInterface.php">Enlisted Building<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">'; 
                echo '<li class="nav-item active">
                <a class="nav-link" href="../../owner/owner_profile.php">My Profile<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">';
                echo '<li class="nav-item active">
                            <a class="nav-link" href="../../payment/payment_statement.php">Rent Statments</a>
                            </li>'; 
                
            }
      ?>
    </ul>
  </div>
</nav>
