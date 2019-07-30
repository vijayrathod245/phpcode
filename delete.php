<?php 
include('db.php');

if($_POST['action']=='delete'){
    $id = $_POST['id'];
    $qry_del = "delete from student where id=$id";
    $res_del = mysqli_query($conn, $qry_del);
    header("location:view.php");
}

?>