<?php 
    include('header.php'); 
	//include('db.php');
    if(@$_POST['submit']){
        
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $image = rand(0,1000). $_FILES['image']['name'];
			  $path = 'image/';
		  	move_uploaded_file($_FILES['image']['tmp_name'],$path.$image);

        echo $qry = "insert into admin(`name`,`email`,`password`,`image`)values('$name','$email','$password','$image')";
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
                  <h6 class="c-grey-900">Add Admin
                  </h6>
                  <div class="mT-30">
                    <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name
                        </label> 
                        <input type="text" name="name"  class="form-control"  aria-describedby="emailHelp" placeholder="Enter name"> 
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email
                        </label> 
                        <input type="email" name="email" class="form-control"  aria-describedby="emailHelp" placeholder="Enter email"> 
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Password
                        </label> 
                        <input type="password" name="password" class="form-control"  placeholder="Password">
                      </div>
                      <div class="form-group">
                          <label for="exampleFormControlFile1">Image</label>
                          <input type="file" name="image"  class="form-control-file">
							            
                      </div>
					  
					  <div class="form-group">
                          <label for="inputState">Country</label>
                          <select class="form-control col-md-6" id="country" name="country">
							<option selected>Choose Country...</option>
							  <?php $country_qry="select * from country";
								$country_res=mysqli_query($conn, $country_qry);
								while($country_arr=mysqli_fetch_array($country_res)){?>
							<option value="<?php echo $country_arr['country_id'];?>"><?php echo $country_arr['countryname'];?>
							</option>
							<?php  } ?>
						</select>
                        </div>
						
						<div class="form-group">
                          <label for="inputState">State</label>
                          <select class="form-control col-md-6" name="state" id="state">
							<option selected>Choose State...</option>
							</select>
                        </div>
						
						<div class="form-group">
                          <label for="inputState">City</label>
                          <select class="form-control col-md-6" name="city" id="city">
							<option selected>Choose City...</option>
						</select>
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