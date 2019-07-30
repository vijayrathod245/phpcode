

<?php 
	include('db.php');
	if(!empty($_POST["state_id"])){?>
	<?php 
	$state_id = $_POST['state_id'];
	$qry_sel_state = "select * from city where state_id=$state_id";
    $res_sel = mysqli_query($conn, $qry_sel_state);
    
?>
    
       <select class="form-control col-md-4" name="state" id="city">						
	<option selected>Choose State...</option> 
        <?php
	while($state_arr=mysqli_fetch_array($res_sel)){?>
	<option value="<?php echo $state_arr['city_id'];?>"><?php echo $state_arr['cityname'];?></option>
<?php  } ?>
   </select>
<?php } ?>
