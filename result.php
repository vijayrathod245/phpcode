<?php 
include('db.php');

if($_POST['action']=='delete'){
    $id = $_POST['id'];
    $qry_del = "delete from admin where id=$id";
    $res_del = mysqli_query($conn, $qry_del);
    header("location:view_admin.php");
}

if($_POST['action']=='select'){
    $id = $_POST['id'];
    $qry_sel = "select * from admin where id=$id";
    $res_sel = mysqli_query($conn, $qry_sel);
    $arr = mysqli_fetch_array($res_sel);

    $name = $arr['name'];
    $email = $arr['email'];
    $password = $arr['password'];
   // $image = $arr['image'];
    
    echo json_encode(array('name'=>$name, 'email'=>$email, 'password'=>$password));
}


if($_POST['action']=='update'){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
  //  $image = $_POST['image'];

  echo $qry = "update admin set `name`='$name',`email`='$email',`password`='$password' where id=$id";
   // $ures = mysqli_query($conn, $uqry);
   mysqli_query($conn, $qry);
}
?>