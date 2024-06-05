<?php
session_start();
if(isset($_SESSION['Email'])){
    $Email = $_SESSION['Email'];

    include 'php/config.php';
    $query = "SELECT Name, Email FROM account_tbl WHERE Email = '$Email'";
    $result = mysqli_query($connections, $query);

    if($result && mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $Name = $row['Name'];   
    }
    
    
    
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        
        if (!isset($_SESSION['Email'])) {
            echo "Session not set";
            exit();
        }
    
        
        $Email = $_SESSION['Email'];
    
        
        $targetDirectory = "uploads/";
        $targetFile = $targetDirectory . basename($_FILES["photo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
        
        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    
       
        if ($_FILES["photo"]["size"] > 50000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
    
       
        if (!in_array($imageFileType, array("jpg", "png", "jpeg", "gif"))) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
    
       
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
           
            $uniqueFilename = uniqid() . "." . $imageFileType;
            $targetFilePath = $targetDirectory . $uniqueFilename;
    
          
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath)) {
                
                $updateQuery = "UPDATE account_tbl SET Photo = '$uniqueFilename' WHERE Email = '$Email'";
                if (mysqli_query($connections, $updateQuery)) {
                    echo "<script>window.location.href='login.php?reg_success=true';</script>";
                    exit(); 
                    
                } else {
                    echo "Error updating record: " . mysqli_error($connections);
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}
else{
    echo "<script>window.location.href='login.php?show_error=true';</script>";
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
    <title>Register-photo</title>
  </head>
  <body>
    <section>
      <form action="registerphoto.php" method="post" enctype="multipart/form-data">
        <div class="form-title">
          <h1>Upload Photo</h1>
        </div>

        <div class="form-wrapper">
          <div class="formbox">
            <img id="imagedis" src="images/profile.png" alt="" />
            <input
              name="photo"
              id="imgup"
              type="file"
              required
              accept="image/*"
              onchange="previewPhoto()"
            />
          </div>
          <div class="formbox">
            <input type="submit" name="submit" />
          </div>

          <div class="formbox">
            <a href="login.php">Already Had an Account</a>
          </div>
        </div>
      </form>
    </section>
  </body>

  <script>
    function previewPhoto() {
      const fileInput = document.getElementById("imgup");
      const previewImg = document.getElementById("imagedis");
      const file = fileInput.files[0];

      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          previewImg.src = e.target.result;
          previewImg.style.display = "block";
        };
        reader.readAsDataURL(file);
      } else {
        previewImg.src = "#";
        previewImg.style.display = "none";
      }
    }
  </script>
</html>
