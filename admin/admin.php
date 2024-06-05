<?php
    session_start();
    if(isset($_SESSION['Email'])){
        $Email = $_SESSION['Email'];
            include '../php/config.php';

        $profSql = "SELECT Email, Name, loginID, Photo, Position FROM account_tbl WHERE Email = '$Email'";
        $result = mysqli_query($connections, $profSql);

        if($result && mysqli_num_rows($result)){
            $row = mysqli_fetch_assoc($result);
            $NameSession = $row['Name'];
            $NameEmail = $row['Email'];
            $SessionloginID =$row['loginID'];
            $Photo = "../uploads/" .$row['Photo'];

        }
    }
    else{
        echo "<script>window.location.href='../login.php?show_error=true';</script>";
        
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
    
    <title>Admin</title>
</head>
<body>

    <aside>
        <div class="profiles">
            <img src="<?php echo "$Photo"  ?>" alt="">
            <h1><?php echo "$NameSession" ?></h1>
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
             
            
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    Profile
                                </th>
                                 <th>
                                    Name
                                </th>

                                 <th>
                                    Email
                                </th>

                                <th>
                                    Account_Type
                                </th>

                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            include '../php/config.php';
                           $sql = "SELECT *FROM account_tbl";
                            $result = $connections->query($sql);

                            if(!$result){
                                die("Invalid Query: " .$connections->error);
                            }

                          
                        while($row = $result->fetch_assoc()){
                                $loginID = $row['loginID'];
                                 $Photos = isset($row['Photo']) ? "../uploads/" . $row['Photo'] : '';


                                 if($row['Account_Type'] == 1){
                                    $position = "Admin";
                                    $link = "function/editadmin.php?loginID=$loginID";
                                 }
                                 elseif($row['Account_Type'] == 2){
                                    $position = "Staff";
                                    $link = "function/editstaff.php?loginID=$loginID";
                                 }
                                 else{
                                    $position = "Patient";
                                    $link = "function/editpatient.php?loginID=$loginID";
                                 }

                                echo '
                            <tr>
                                <td>
                                    <img src="'.$Photos.'" alt="">
                                </td>

                                 <td>
                                  '.$row['Name'].'
                                </td>

                                 <td>
                                   '.$row['Email'].'
                                </td>

                                <td>
                                   Admin
                                </td>

                                 <td>
                                 <div class="button-container">
                                    <a href="'.$link.'">Edit</a>
                                    <button>Delete</button>
                                  </div>
                                </td>


                            </tr>';
                             }
                            ?>
                        </tbody>
                    </table>
            </div>
             
        </section>
    </main>
</body>
</html>