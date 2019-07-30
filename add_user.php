<?php include('header.php'); 
//include('db.php');
if(@$_POST['submit']){
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $phone = $_POST['phone'];
  $gender = $_POST['gender'];
  $country = $_POST['country'];
  $state = $_POST['state'];
  $city = $_POST['city'];
  $image = rand(0,1000). $_FILES['image']['name'];
  $path = 'image/';
  move_uploaded_file($_FILES['image']['tmp_name'], $path.$image);


  echo $qry = "insert into user(
          `fullname`,
          `email`,
          `password`,
          `phone`,
          `gender`,
          `country`,
          `state`,
          `city`,
          `image`
          )
          values(
          '$fullname',
          '$email',
          '$password',
          '$phone',
          '$gender',
          '$country',
          '$state',
          '$city',
          '$image'
          )";
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
                  <h6 class="c-grey-900">Add User
                  </h6>
                  <div class="mT-30">
                    <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name
                        </label> 
                        <input type="text" required class="form-control" name="fullname" aria-describedby="emailHelp" placeholder="Enter name"> 
                        
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email
                        </label> 
                        <input type="email" required class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email"> 
                        
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Password
                        </label> 
                        <input type="password" class="form-control" name="password" placeholder="Password">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Phone
                        </label> 
                        <input type="text" required class="form-control" name="phone" aria-describedby="emailHelp" placeholder="Enter phone"> 
                        
                      </div>
                      <div class="form-group">
                      
                      <div class="form-check-inline">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="gender" value="male">Male
                          </label>
                      </div>
                      <div class="form-check-inline">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="gender" value="female">Female
                          </label>
                      </div>
                      </div>
                      <div class="form-group ">
                      <label for="inputState">Country
                          </label> 
                          <select  name="country" class="form-control">
                            <option selected="selected">Choose...
                            </option>
                            <option>...
                            </option>
                          </select>
                      </div>
                      <div class="form-group ">
                      <label for="inputState">State
                          </label> 
                          <select  name="state" class="form-control">
                            <option selected="selected">Choose...
                            </option>
                            <option>...
                            </option>
                          </select>
                      </div>
                      <div class="form-group ">
                      <label for="inputState">City
                          </label> 
                          <select  name="city" class="form-control">
                            <option selected="selected">Choose...
                            </option>
                            <option>...
                            </option>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="exampleFormControlFile1">Image</label>
                          <input type="file" name="image"  class="form-control-file">
							            
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Submit"/>
                  
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
<?php include('footer.php'); ?>