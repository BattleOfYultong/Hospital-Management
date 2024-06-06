<?php
session_start();

if (isset($_SESSION['Email'])) {
    $Email = $_SESSION['Email'];
    include '../../php/config.php';

    // Fetch logged-in user information
    $profSql = "SELECT Email, Name, loginID, Photo, Account_Type FROM account_tbl WHERE Email = ?";
    $stmt = $connections->prepare($profSql);
    $stmt->bind_param("s", $Email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $NameSession = $row['Name'];
        $NameEmail = $row['Email'];
        $SessionloginID = $row['loginID'];
        $Photo = "../../uploads/" . $row['Photo'];
        $accountPosition = $row['Account_Type'];

        if ($accountPosition == 1) {
            $position = "Admin";
        } elseif ($accountPosition == 2) {
            $position = "Staff";
        } else {
            $position = "Patient";
        }
    } else {
        // Handle case where query fails or no rows are returned
        echo "Error fetching user data or no user found.";
        exit;
    }
    $stmt->close();
} else {
    echo "<script>window.location.href='../login.php?show_error=true';</script>";
    exit;
}

// Fetch another user's information if 'loginID' is provided
if (isset($_GET['loginID'])) {
    $userid = $_GET['loginID'];
    include '../../php/config.php';

    $userProfQuery = "SELECT * FROM account_tbl WHERE loginID = ?";
    $stmt = $connections->prepare($userProfQuery);
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $userresult = $stmt->get_result();

    if ($userresult->num_rows == 1) {
        $row = $userresult->fetch_assoc();
        $UserName = $row['Name'];
        $UserID = $row['loginID'];
        $UserPhoto = "../../uploads/" . $row['Photo'];
        $UserEmail = $row['Email'];
        $UserPosition = $row['Position'];
        $UserPassword = $row['Password'];
    } else {
        echo "Error: Record not found.";
        exit;
    }
    $stmt->close();
}

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['Submit'])) {
      
        $Name = $_POST['Name'];
        $Email = $_POST['Email'];
        $Password = $_POST['Password'];
    

        $sql = "UPDATE account_tbl SET Name = '$Name', Email = '$Email', Password = '$Password' WHERE loginID = $UserID ";

        if($connections->query($sql) === TRUE){
                echo "<script>window.location.href ='editadmin.php?loginID=$UserID';</script>";
                
        }
        else{
            echo "Error:" .$sql. "br" .$connections->error;
        }


    } 
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
    <title>Edit <?php echo " $UserName", " $UserID"  ?></title>
</head>
<body>
    <aside>
        
        <div class="profiles">
            <img src="<?php echo $Photo ?>" alt="">
            <h1><?php echo $NameSession ?></h1>
             <h2><?php echo "$position" ?></h2>
            
        </div>
        <ul>
            <li class="li-act">
                <a href="../admin.php">
                    <span>Edit Users</span>
                </a>
            </li>

            <li>
                <a href="../staffs.php">
                    <span>Staffs</span>
                </a>
            </li>

            <li>
                <a href="../patient.php">
                    <span>Patients</span>
                </a>
            </li>
            <li>                
                <a href="../crud.php">
                    <span>Salaries</span>
                </a>
            </li>
            <li>
                <a href="crud.php">
                    <span>Payments</span>
                </a>
            </li>
            <li>
                <a href="../../php/logout.php">
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
                    <form class="" action="" method="POST" enctype="multipart/form-data">

                         <div class="editboximg">
                            <img src="<?php echo "$UserPhoto" ?>" alt="Current Photo" width="100">
                        </div>

                    <div class="editboxwrapper">
                         <div class="editbox">
                            <label for="name">ID:</label>
                            <input type="number" name="loginID" value="<?php echo $UserID ?>" readonly>
                        </div>

                        <div class="editbox">
                            <label for="name">Name:</label>
                            <input type="text" name="Name" value="<?php echo $UserName?>" >
                        </div>
                        <div class="editbox">
                            <label for="email">Email:</label>
                            <input type="email" name="Email" value="<?php echo $UserEmail ?>" >
                        </div>

                         <div class="editbox">
                            <label for="email">Password:</label>
                            <input type="text" name="Password" value="<?php echo $UserPassword ?>" >
                        </div>

                         <div class="editbox">
                            <label for="email">Role:</label>
                            <input type="text" name="Role" value="ADMIN" readonly>
                        </div>
                     </div>  
                       
                       
                        <div class="editbox">
                           <input type="Submit" name="Submit" value="Edit">
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
