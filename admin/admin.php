<?php
session_start();

if (isset($_SESSION['Email'])) {
    $Email = $_SESSION['Email'];
    include '../php/config.php';

    $profSql = "SELECT Email, Name, loginID, Photo, Account_Type FROM account_tbl WHERE Email = '$Email'";
    $result = mysqli_query($connections, $profSql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $NameSession = $row['Name'];
        $NameEmail = $row['Email'];
        $SessionloginID = $row['loginID'];
        $Photo = "../uploads/" . $row['Photo'];
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
    
    <title>Admin</title>
</head>
<body>

    <aside>
        <div class="profiles">
            <img src="<?php echo "$Photo"  ?>" alt="">
            <h1><?php echo "$NameSession" ?></h1>
            <h2><?php echo "$position" ?></h2>
        </div>

        <ul>
            <li class="li-act">
                <a href="">
                    <span>Edit Users</span>
                </a>
            </li>

            <li>
                <a href="staffs.php">
                    <span>Staffs</span>
                </a>
            </li>

            <li>
                <a href="patient.php">
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
                <div class="button-containers">
                    <button onclick="Openadmin()">ADD ADMIN</button>
                    <button onclick=" OpenStaff()">ADD STAFF </button>
                    <button onclick="OpenPatient()">ADD PATIENT</button>
                </div>

            
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

                                 if($row['Email'] == $Email ){
                                    continue;
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
                                  '.$position.'
                                </td>

                                 <td>
                                 <div class="button-container">
                                    <a href="'.$link.'">Edit</a>
                                     <button onclick="confirmDelete(\'' .  $loginID . '\');">Delete</button>
                                  </div>
                                </td>


                            </tr>';
                             }
                            ?>
                        </tbody>
                    </table>


                    <form class="container-form" id="createadmin" enctype="multipart/form-data" action="../php/createadmin.php" method="post" >
                            <div class="header-container">
                                <h2>ADD ADMIN</h2>
                                <i onclick="closeAdmin1()" class="fa-solid fa-circle-xmark exiticon1"></i>
                            </div>

                            <div class="form-wrap2">
                                <div class="formbox2">
                                    <img id="imagedis" src="../images/profile.png" alt="" />
                                    <input
                                        name="create-photo"
                                        id="imgup"
                                        type="file"
                                        required
                                        accept="image/*"
                                        onchange="previewPhoto()"
                                        />
                                </div>


                                <div class="formbox2">
                                    <input type="text" name="Name" id="" placeholder="Name">
                                </div>

                                  <div class="formbox2">
                                    <input type="email" name="Email" id="" placeholder="Email">
                                </div>

                                <div class="formbox2">
                                    <input type="text" name="Password" id="" placeholder="Password">
                                </div>

                                  <div class="formbox2">
                                    <input type="Submit" name="" id="" value="Submit">
                                </div>
                            </div>
                    </form>  


                    <!-----For staff  ---->


                     <form class="container-form" id="createstaff" enctype="multipart/form-data" action="../php/createstaff.php" method="post" >
                            <div class="header-container">
                                <h2>ADD STAFF</h2>
                                <i onclick="closeStaff1()" class="fa-solid fa-circle-xmark exiticon2"></i>
                            </div>

                            <div class="form-wrap2">
                                <div class="formbox2">
                                    <img id="imagedis2" src="../images/profile.png" alt="" />
                                    <input
                                        name="create-photo"
                                        id="imgup2"
                                        type="file"
                                        required
                                        accept="image/*"
                                        onchange="previewPhoto2()"
                                        />
                                </div>


                                <div class="formbox2">
                                    <input type="text" name="Name" id="" placeholder="Name">
                                </div>

                                  <div class="formbox2">
                                    <input type="email" name="Email" id="" placeholder="Email">
                                </div>

                                <div class="formbox2">
                                    <input type="text" name="Password" id="" placeholder="Password">
                                </div>

                                <div class="formbox2">
                                 <select name="Position" id="">
                                    <option value="Doctor">Doctor</option>
                                    <option value="Nurse">Nurse</option>
                                    <option value="Staff">Staff</option>
                                </select>
                                </div>

                                  <div class="formbox2">
                                    <input type="Submit" name="" id="" value="Submit">
                                </div>
                            </div>
                    </form>  

                    <!------For patient ----->


                     <form class="container-form" id="createpatient" enctype="multipart/form-data" action="../php/createpatient.php"
                      method="post" >
                            <div class="header-container">
                                <h2>ADD PATIENT</h2>
                                <i onclick="closePatient1()" class="fa-solid fa-circle-xmark exiticon3"></i>
                            </div>

                            <div class="form-wrap2">
                                <div class="formbox2">
                                    <img id="imagedis3" src="../images/profile.png" alt="" />
                                    <input
                                        name="create-photo"
                                        id="imgup3"
                                        type="file"
                                        required
                                        accept="image/*"
                                        onchange="previewPhoto3()"
                                        />
                                </div>


                                <div class="formbox2">
                                    <input type="text" name="Name" id="" placeholder="Name">
                                </div>

                                  <div class="formbox2">
                                    <input type="email" name="Email" id="" placeholder="Email">
                                </div>

                                <div class="formbox2">
                                    <input type="text" name="Password" id="" placeholder="Password">
                                </div>



                                  <div class="formbox2">
                                    <input type="Submit" name="" id="" value="Submit">
                                </div>
                            </div>
                    </form>  

            </div>




             
        </section>
    </main>


    
</body>
<!---for Containers --->
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

     function previewPhoto2() {
      const fileInput = document.getElementById("imgup2");
      const previewImg = document.getElementById("imagedis2");
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


     function previewPhoto3() {
      const fileInput = document.getElementById("imgup3");
      const previewImg = document.getElementById("imagedis3");
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



<script>
    function Openadmin(){
        const createAdmin = document.getElementById('createadmin');
       createAdmin.classList.add('show');
    }
    function closeAdmin1(){
        const createAdmin = document.getElementById('createadmin');
       createAdmin.classList.remove('show');
    }
    function OpenStaff(){
        const createStaff = document.getElementById('createstaff');
       createStaff.classList.add('show');
    }
    function closeStaff1(){
        const createStaff = document.getElementById('createstaff');
       createStaff.classList.remove('show');
    }

     function OpenPatient(){
        const createPatient = document.getElementById('createpatient');
       createPatient.classList.add('show');
    }
    function closePatient1(){
        const createPatient = document.getElementById('createpatient');
       createPatient.classList.remove('show');
    }

</script>

<script>
    function confirmDelete(loginID) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#FAEF5D',
            cancelButtonColor: '#FAEF5D',
            confirmButtonText: '<span style="color: black">Yes, delete it!</span>', // Set color to black
            cancelButtonText: '<span style="color: black">Cancel</span>' // Set color to black
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "../php/delete.php?loginID=" + loginID;
            }
        });
    }
</script>
</html>