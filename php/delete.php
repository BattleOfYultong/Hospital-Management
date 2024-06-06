<?php
if (isset($_GET['loginID'])) {
    $userid = $_GET['loginID'];
    include 'config.php';


    $sql = "DELETE FROM account_tbl WHERE loginID = $userid";

    if($connections->query($sql) === TRUE){
        echo "<script>window.location.href='../admin/admin.php?delete_success';</script>";
    }
    
}








