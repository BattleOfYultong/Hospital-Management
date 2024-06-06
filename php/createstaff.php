<?php
session_start();


include 'config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Name = $_POST['Name'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    $Account_type = 2;
    $position = $_POST['Position'];

   
    if (!empty($_FILES["create-photo"]["tmp_name"]) && is_uploaded_file($_FILES["create-photo"]["tmp_name"])) {
        
        $targetDirectory = "../uploads/"; 
        $targetFile = $targetDirectory . basename($_FILES["create-photo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        
        $check = getimagesize($_FILES["create-photo"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

       
        if ($_FILES["create-photo"]["size"] > 50000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        
        $allowedFormats = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowedFormats)) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

       
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            
            $uniqueFilename = uniqid() . "." . $imageFileType;
            $targetFilePath = $targetDirectory . $uniqueFilename;

            
            if (move_uploaded_file($_FILES["create-photo"]["tmp_name"], $targetFilePath)) {
              
                $sql = "INSERT INTO account_tbl (Email, Name, Password, photo, Account_Type, Position) VALUES 
                ('$Email','$Name','$Password','$uniqueFilename', $Account_type, '$position')";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        
        $defaultImage = "../images/profile.png";
        $sql = "INSERT INTO account_tbl (Email, Name, Password, Photo, Account_Type, Position) VALUES 
        ('$Email','$Name','$Password','$defaultImage', $Account_type, '$position')";
    }

   


    

   
    if ($connections->query($sql) === TRUE) {
       
        echo "<script>window.location.href='../Admin/admin.php?Create_success=true';</script>";
        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . $connections->error;
    }

   


}
?>