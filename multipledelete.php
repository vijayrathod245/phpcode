<?php 
include('db.php');

$ids=$_POST['ids'];
$im=explode(',',$ids);
for($i=0;$i<sizeof($im);$i++)
{
$id=$im[$i];
$qry="delete from admin where id=$id";
$res=mysqli_query($conn, $qry);
}
?>