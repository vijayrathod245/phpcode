<?php 
    include('header.php'); 
	//include('db.php');
    if(@$_POST['submit']){
        $state = $_POST['state'];
        $cityname = $_POST['cityname'];

        echo $qry = "insert into city values('null','$state','$cityname')";
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
					<div class="form-group" id="div_state_item">
						<select class="form-control col-md-4" name="state" id="state">
							
							<option selected>Choose State...</option>
							  <?php $state_qry="select * from state";
								$state_res=mysqli_query($conn, $state_qry);
								while($state_arr=mysqli_fetch_array($state_res)){?>
							<option value="<?php echo $state_arr['id'];?>"><?php echo $state_arr['statename'];?>
							</option>
							<?php  } ?>
						</select>
					</div>
					<div class="form-group">
                        <label for="exampleInputEmail1">City Name
                        </label> 
                        <input type="text" name="cityname" class="form-control" aria-describedby="emailHelp" placeholder="Enter state name"> 
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