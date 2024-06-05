<?php
    session_start();
    include 'php/config.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['Submit'])) {
      

        $Name = $_POST['Name'];
        $Email = $_POST['Email'];
        $Password = $_POST['Password'];
        $Account_type = $_POST['Account_type'];

        $sql = "INSERT INTO account_tbl (Name, Email, Password, Account_Type) VALUES 
        ('$Name', '$Email', '$Password', $Account_type)";
        
        if($connections->query($sql) === TRUE){
           if ($Account_type == 2) {
                $_SESSION['Email'] = $Email;
                echo "<script>window.location.href ='registerstaff.php?register_success=true';</script>";
            } else {
                 $_SESSION['Email'] = $Email;
                echo "<script>window.location.href ='registerphoto.php?register_success=true';</script>";
                }
        }
        else{
            echo "Error:" .$sql. "br" .$connections->error;
        }


    } else {
        echo "<script>window.location.href='registerposition.php?show_error=true';</>";
        exit();
    }
}


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="SweetAlert/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="SweetAlert/sweetalert2.min.css" />
    <link rel="stylesheet" href="fontawesome-free-6.5.2-web/css/all.min.css" />
    <link rel="stylesheet" href="css/login.css" />
    <title>Register</title>
  </head>
  <body>
    <section>
      <form action="register.php" method="post">
        <div class="form-title">
          <h1>Register</h1>
        </div>

        <div class="form-wrapper">
          <div class="formbox">
            <input type="text" name="Name" id="" placeholder="Name" required  />
            <i class="fa-solid fa-user form-icons"></i>
          </div>

          <div class="formbox">
            <input type="email" name="Email" id="" placeholder="Email" required />
            <i class="fa-solid fa-envelope form-icons"></i>
          </div>

          <div class="formbox">
            <input type="password" name="Password" id="" placeholder="Password" required />
            <i class="fa-solid fa-lock form-icons"></i>
          </div>

          <div class="formbox">
            <select name="Account_type" id="" required>
              <option value="1">ADMIN</option>
              <option value="2">STAFFS</option>
              <option value="3">PATIENT</option>
            </select>
          </div>

          <div class="formbox">
            <input type="submit" name="Submit" />
          </div>

          <div class="formbox">
            <a href="login.php">Already Had an Account</a>
          </div>
        </div>
      </form>
    </section>
  </body>
</html>
