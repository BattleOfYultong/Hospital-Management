<?php

session_start();
$Email = $password1 = "";
$EmailErr = $password1Err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["Email"])) {
        $EmailErr = "Email is Required!";
    } else {
        $Email = $_POST["Email"];
    }

    if (empty($_POST["password1"])) {
        $password1Err = "Password is Required!";
    } else {
        $password1 = $_POST["password1"];
    }

    if ($Email && $password1) {
        include("php/config.php");

        $check_Email = mysqli_query($connections, "SELECT * FROM account_tbl WHERE Email='$Email'");
        $check_Email_row = mysqli_num_rows($check_Email);

        if ($check_Email_row > 0) {
            while ($row = mysqli_fetch_assoc($check_Email)) {
                $db_password1 = $row["Password"];
                $db_account_type = $row["Account_Type"];
                if ($password1 == $db_password1) {
                if ($db_account_type == "1") {
                    $_SESSION['Email'] = $Email;
                    echo "<script>window.location.href='Admin/Admin.php?show_name=true';</script>";
                }
                elseif($db_account_type == "2"){
                    $_SESSION['Email'] = $Email;
                    echo "<script>window.location.href='staff/staff.php?show_name=true';</script>";
                } 
                else{
                    $_SESSION['Email'] = $Email;
                    echo "<script>window.location.href='patient/patient.php?show_name=true';</script>";
                }       
               
            } else {
                $password1Err = "Incorrect password!";
            }
            }
         }
        
        else {
            $EmailErr = "Email is not registered!";
        }
    }
    // Reset error messages when the page is loaded initially
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    $EmailErr = $password1Err = "";
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
    <title>Login</title>
  </head>
  <body>
    <section>
      <form
        autocomplete="off"
        method="post"
        action="<?php echo $_SERVER['PHP_SELF']; ?>"
      >
        <div class="form-title">
          <h1>Login</h1>
        </div>

        <div class="Errors">
           <?php echo "$EmailErr" ?> 
          <?php echo " $password1Err" ?> 
        </div>

        <div class="form-wrapper">
          <div class="formbox">
            <input type="email" name="Email" id="" placeholder="Email" />
            <i class="fa-solid fa-user form-icons"></i>
          </div>

          <div class="formbox">
            <input type="password" name="password1" id="" placeholder="Password" />
            <i class="fa-solid fa-lock form-icons"></i>
          </div>

          <div class="formbox">
            <input type="submit" />
          </div>

          <div class="formbox">
            <a href="register.php">Create an Account</a>
          </div>
        </div>
      </form>
    </section>
  </body>
</html>
