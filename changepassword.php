<?php
//include('header.php');
include('db.php');
if(@$_POST['submit'])
	{
		$id=$_SESSION['admin'];
		$oldpassword=$_POST['oldpassword'];
		$newpassword=$_POST['newpassword'];
		$confpassword=$_POST['confpassword'];
		
		$qry="select * from admin where password='$oldpassword'";
		$res=mysqli_query($conn, $qry);
		//session_destroy();
		header("location:logout.php");
		
		if($res)
			{
				$arr=mysqli_fetch_array($res);
				if($oldpassword==$newpassword)
					{
						echo "password same";
					}
					else
					{
						if($newpassword==$confpassword)
						{
						$sql="update admin set password='$newpassword' where id=$id";
						mysqli_query($conn, $sql);
						session_destroy();
						header("location:dashboard.php");
						}
						else
						{
							echo "does not match";
						}
				
					}
			}
			else
			{
				echo "does not match";
			}
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
                        <label for="exampleInputEmail1">OldPassword
                        </label> 
                        <input type="password" name="oldpassword"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name"> 
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">NewPassword
                        </label> 
                        <input type="password" name="newpassword" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"> 
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">ConfPassword
                        </label> 
                        <input type="password" name="confpassword" class="form-control" id="exampleInputPassword1" placeholder="Password">
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