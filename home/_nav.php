<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
        <a class="nav-link" href="Building/Apartments/index.php">Explore Apartments<span class="sr-only">(current)</span></a>
      </li>
      <?php  
            if (!isset($_SESSION['email']) && !isset($_SESSION['type'])) {
              
              echo '<li class="nav-item active">
                      <a class="nav-link" href="ProfileSystem/login.php">Login <span class="sr-only">(current)</span></a>
                      </li>
                      <li class="nav-item active">
                   <a class="nav-link" href="ProfileSystem/signup.php">Sign Up<span class="sr-only">(current)</span></a>
                    </li>';
            }
            if (isset($_SESSION['email']) && isset($_SESSION['type'])) {
              if ($_SESSION['type'] == 'owner'){
                  echo '<li class="nav-item active">
                  <a class="nav-link" href="ownerInterface.php">My Buildings<span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">'; 
                }
              else if ($_SESSION['type'] == 'tenant') {
                echo '<li class="nav-item active">
                  <a class="nav-link" href="tenant/tenant_profile.php">My Profile<span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">';
              }
            }
            ?>
            <?php 
                if (isset($_SESSION['email']) && isset($_SESSION['type'])){
                    echo '<li class="nav-item active">
                      <a class="nav-link" href="ProfileSystem/logout.php">Logout</a>
                    </li>';
                    if ($_SESSION['type'] == 'owner') {
                      echo '<li class="nav-item active">
                            <a class="nav-link" href="owner/owner_profile.php">Account Details</a>
                            </li>';
                    }
                    if ($_SESSION['type'] == 'tenant') {
                      echo '<li class="nav-item active">
                            <a class="nav-link" href="tenant/tenant_profile.php">Account Details</a>
                            </li>';
                    }
                }
            ?>
      
    </ul>
    
  </div>
</nav>
