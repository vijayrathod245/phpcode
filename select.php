<?php 
include('db.php');
if($_POST['action']=='select'){
    $id = $_POST['id'];
    $qry = "select * from student where id=$id";
    $res = mysqli_query($conn, $qry);
    $arr = mysqli_fetch_array($res);

    $firstname = $arr['firstname'];
    $gender = $arr['gender'];
    $hobby=explode(',',$arr['hobby']);

    echo json_encode(array('firstname'=>$firstname, 'gender'=>$gender, 'hobby'=>$hobby));

}
?>