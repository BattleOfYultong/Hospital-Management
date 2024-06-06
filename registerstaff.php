<?php

session_start();
if (isset($_SESSION['Email'])) {
    $Email = $_SESSION['Email'];
    include 'php/config.php';

    $profSql = "SELECT Email, Name, loginID FROM account_tbl WHERE Email = '$Email'";
    $result = mysqli_query($connections, $profSql);

    if ($result && mysqli_num_rows($result)) {
        $row = mysqli_fetch_assoc($result);
        $NameSession = $row['Name'];
        $SessionloginID = $row['loginID'];
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['Submit'])) {
      

      $Position = $_POST['Position'];

        $sql = "UPDATE account_tbl SET Position = '$Position' WHERE loginID = $SessionloginID ";

        if($connections->query($sql) === TRUE){
                echo "<script>window.location.href ='registerphoto.php?register_success=true';</script>";
                
        }
        else{
            echo "Error:" .$sql. "br" .$connections->error;
        }


    } 
}


} else {
    echo "<script>window.location.href='login.php?show_error=true';</script>";
    exit();
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
      <form action="registerstaff.php" method="post">
        <div class="form-title">
          <h1>Position</h1>
        </div>

        <div class="form-wrapper">
          <div class="formbox">
            <select name="Position" id="">
              <option value="Doctor">Doctor</option>
              <option value="Nurse">Nurse</option>
              <option value="Staff">Staff</option>
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
