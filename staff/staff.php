<?php
session_start();

if (isset($_SESSION['Email'])) {
    $Email = $_SESSION['Email'];
    include '../php/config.php';

    $profSql = "SELECT Email, Name, loginID, Photo, Account_Type, Position FROM account_tbl WHERE Email = '$Email'";
    $result = mysqli_query($connections, $profSql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $NameSession = $row['Name'];
        $NameEmail = $row['Email'];
        $SessionloginID = $row['loginID'];
        $Photo = "../uploads/" . $row['Photo'];
        $accountPosition = $row['Account_Type'];
        $profession = $row['Position'];

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
} else {
    echo "<script>window.location.href='../login.php?show_error=true';</script>";
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../SweetAlert/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="../SweetAlert/sweetalert2.min.css" />
    <link rel="stylesheet" href="../fontawesome-free-6.5.2-web/css/all.min.css" />
    <link rel="stylesheet" href="../css/dashboard.css">
    
    <title>Staff</title>
</head>
<body>

    <aside>
        <div class="profiles">
            <img src="<?php echo "$Photo"  ?>" alt="">
            <h1><?php echo "$NameSession" ?></h1>
            <h2><?php echo "$profession" ?></h2>
        </div>

        <ul>
            <li class="li-act">
                <a href="">
                    <span>dashboard</span>
                </a>
            </li>

           
               <li>
                <a href="crud.php">
                    <span>My Salary</span>
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
               

            </div>




             
        </section>
    </main>


    
</body>

</html>