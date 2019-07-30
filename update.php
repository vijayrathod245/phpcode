<?php 
include('db.php');
if($_POST['action']=='update'){
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $gender = $_POST['gender'];
    $hobby=implode(',',$_POST['hobby']);

  echo $qry = "update student set `firstname`='$firstname',`gender`='$gender',`hobby`='$hobby' where id=$id";
   // $ures = mysqli_query($conn, $uqry);
   mysqli_query($conn, $qry);

   /* if($ures)
{
	echo "Your data is updated..";	
}
else
{
	echo "your data is not updated..";
}	
*/
}

//mysqli_query($conn, $qry);
?>
