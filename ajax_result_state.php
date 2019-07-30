<?php 
	include('db.php');
	if(!empty($_POST["country_id"])){?>
	<?php 
    $country_id = $_POST['country_id'];
	//$qry_sel_state = "select * from state where country_id=$country_id";
    //$res_sel = mysqli_query($conn, $qry_sel_state);
	
	$qry_sel_state = "select * from state where country_id=$country_id";
    $res_sel = mysqli_query($conn, $qry_sel_state);

?>
    
    <select class="form-control col-md-4" name="state" id="city">						
	<option selected>Choose State...</option> 
        <?php
	while($state_arr=mysqli_fetch_array($res_sel)){?>
	<option value="<?php echo $state_arr['state_id'];?>"><?php echo $state_arr['statename'];?></option>
<?php  } ?>
   </select>
<?php } ?>
