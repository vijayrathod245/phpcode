<?php 
    include('header.php'); 
	//include('db.php');
    if(@$_POST['submit']){
        $country_id = $_POST['country_id'];
        $statename = $_POST['statename'];

       // echo $qry = "insert into state values('null','$country','$statename')";
		echo $qry = "insert into state (`country_id`,`statename`)values('$country_id','$statename')";
        $res = mysqli_query($conn, $qry);
    }

?>
        <main class="main-content bgc-grey-100">
          <div id="mainContent">
            <div class="row gap-20 masonry pos-r">
              <div class="masonry-sizer col-md-6">
              </div>
              <div class="masonry-item col-md-6">
                <div class="bgc-white p-20 bd">
                  <h6 class="c-grey-900">Add State
                  </h6>
                  <div class="mT-30">
                    <form method="post" enctype="multipart/form-data">
					<div class="form-group">
							<select class="form-control col-md-4" id="state" name="country_id">
								
								<option selected>Choose Country...</option>
								  <?php $country_qry="select * from country";
									$country_res=mysqli_query($conn, $country_qry);
									while($country_arr=mysqli_fetch_array($country_res)){?>
								<option value="<?php echo $country_arr['id'];?>"><?php echo $country_arr['countryname'];?>
								</option>
								<?php  } ?>
							</select>
					</div>
					<div class="form-group">
                        <label for="exampleInputEmail1">State Name
                        </label> 
                        <input type="text" name="statename" class="form-control" aria-describedby="emailHelp" placeholder="Enter state name"> 
                     </div>
                      
                      <input type="submit" name="submit" class="btn btn-primary" value="Submit" />
                      
                    </form>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </main>
       
      </div>
    </div>
    <?php include('footer.php'); ?>