<?php 
    include('header.php'); 
	//include('db.php');
    if(@$_POST['submit']){
        
        $countryname = $_POST['countryname'];

        echo $qry = "insert into country(`countryname`)values('$countryname')";
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
                  <h6 class="c-grey-900">Add Country
                  </h6>
                  <div class="mT-30">
                    <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Country Name
                        </label> 
                        <input type="text" name="countryname" class="form-control" aria-describedby="emailHelp" placeholder="Enter country name"> 
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