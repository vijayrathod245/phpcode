
        </main>
        <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600">
          <span>Copyright © 2017 Designed by 
            <a href="https://colorlib.com" target="_blank" title="Colorlib">Colorlib
            </a>. All rights reserved.
          </span>
        </footer>
      </div>
    </div>
    <script type="text/javascript" src="js/vendor.js">
    </script>
    <script type="text/javascript" src="js/bundle.js">
    </script>
    <script src="js/custom.js"></script>
    
    
  </body>
</html>

<div class="container">
  <!-- Button to Open the Modal -->
  <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    Open modal
  </button>-->

  <!-- The Modal -->
  <div class="modal fade" id="adminupdatemodel">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Update Record</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <div class="bgc-white p-20 bd">
                  <h6 class="c-grey-900">Update Admin
                  </h6>
        <div class="mT-30">
                    <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name
                        </label> 
                        <input type="text" name="name" id="name" value="<?php echo @$arr['name']; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name"> 
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email
                        </label> 
                        <input type="email" name="email" id="email" value="<?php echo @$arr['email']; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"> 
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Password
                        </label> 
                        <input type="password" name="password" id="password" value="<?php echo @$arr['password']; ?>" class="form-control" id="exampleInputPassword1" placeholder="Password">
                      </div>
                      <div class="form-group">
                            <label for="exampleFormControlFile1">Image</label>
                            <input type="file" name="image" id="image" class="form-control-file">
                           <!-- <img id="image" src="image/<?php //echo @$arr['image'];?>" width="25px" height="25px" >-->
                      </div>
                      
                        <input type="hidden" name="id" id="id" value="">
                  
                      <input type="submit" name="submit" id="update" class="btn btn-primary" value="Update" />
                      
                    </form>
                  </div>
                  </div>
        </div>
      
        
      </div>
    </div>
  </div>
  
</div>