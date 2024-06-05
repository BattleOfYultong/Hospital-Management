<?php
session_start();
if(isset($_SESSION['Email'])){
    $Email = $_SESSION['Email'];
    include '../../php/config.php';

    // Fetch current admin details
    if(isset($_GET['loginID'])){
        $loginID = $_GET['loginID'];
        $profSql = "SELECT Email, Name, Photo FROM account_tbl WHERE loginID = '$loginID'";
        $result = mysqli_query($connections, $profSql);

        if($result && mysqli_num_rows($result)){
            $row = mysqli_fetch_assoc($result);
            $NameSession = $row['Name'];
            $NameEmail = $row['Email'];
            $Photo = "../../uploads/" . $row['Photo'];
        }
    }

    // Update admin details
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = $_POST['name'];
        $email = $_POST['email'];

        // Handle photo upload
        if(isset($_FILES['photo']) && $_FILES['photo']['error'] == 0){
            $photo = $_FILES['photo']['name'];
            $target = "../../uploads/" . basename($photo);
            move_uploaded_file($_FILES['photo']['tmp_name'], $target);
        } else {
            $photorow = $row['Photo'];
        }

        $updateSql = "UPDATE account_tbl SET Name='$name', Email='$email', Photo='$photo' WHERE loginID='$loginID'";
        if(mysqli_query($connections, $updateSql)){
            echo "<script>window.location.href='../admin.php?update_success=true';</script>";
        } else {
            echo "Error updating record: " . mysqli_error($connections);
        }
    }
} else {
    echo "<script>window.location.href='../login.php?show_error=true';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../SweetAlert/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="../../SweetAlert/sweetalert2.min.css" />
    <link rel="stylesheet" href="../../fontawesome-free-6.5.2-web/css/all.min.css" />
    <link rel="stylesheet" href="../../css/dashboard.css">
    <title>Edit Admin</title>
</head>
<body>
    <aside>
        <div class="profiles">
            <img src="<?php echo $Photo ?>" alt="">
            <h1><?php echo $NameSession ?></h1>
            <h2>ADMIN</h2>
        </div>
        <ul>
            <li class="li-act">
                <a href="">
                    <span>Edit Users</span>
                </a>
            </li>
            <li>
                <a href="">
                    <span>Staffs</span>
                </a>
            </li>
            <li>
                <a href="crud.php">
                    <span>Patients</span>
                </a>
            </li>
            <li>
                <a href="crud.php">
                    <span>Salaries</span>
                </a>
            </li>
            <li>
                <a href="crud.php">
                    <span>Payments</span>
                </a>
            </li>
            <li>
                <a href="../php/logout.php">
                    <span>Log - Out</span>
                </a>
            </li>
        </ul>
    </aside>
    <main>
        <nav>
            <div class="title-sys">
                <h1>Hospital Management</h1>
            </div>
        </nav>
        <section>
            <div class="main-container">
                <div class="edits-container">
                    <form class="editforms" action="" method="POST" enctype="multipart/form-data">

                         <div class="editbox">
                            <img src="<?php echo $Photorow ?>" alt="Current Photo" width="100">
                        </div>

                        <div class="editbox">
                            <label for="name">Name:</label>
                            <input type="text" name="name" value="<?php echo $NameSession ?>" required>
                        </div>
                        <div class="editbox">
                            <label for="email">Email:</label>
                            <input type="email" name="email" value="<?php echo $NameEmail ?>" required>
                        </div>
                       
                       
                        <div class="editbox">
                            <button type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
