<?php 
    include('header.php'); 

    $qry_sel = "select * from admin";
    $res_sel = mysqli_query($conn, $qry_sel);

?>
<main class="main-content bgc-grey-100">
          <div id="mainContent">
            <div class="container-fluid">
              <h4 class="c-grey-900 mT-10 mB-30">Admin Tables
              </h4>
              <div class="row" id="delete">
                <div class="col-md-12">
                  <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <h4 class="c-grey-900 mB-20">Admin Data Table
                    </h4>
                    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
						<th>
							<input type="checkbox" name="checkall" id="checkall"/> 
							<button id="deleteall" value="delete">Delete</button>
						</th>
                          <th>Id
                          </th>
                          <th>Name
                          </th>
                          <th>Email
                          </th>
                          <th>Password
                          </th>
                          <th>Image
                          </th>
                          <th>Action
                          </th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Id
                          </th>
                          <th>Name
                          </th>
                          <th>Email
                          </th>
                          <th>Password
                          </th>
                          <th>image
                          </th>
                          <th>Action
                          </th>
                        </tr>
                      </tfoot>
                      <?php while($arr = mysqli_fetch_array($res_sel)){ ?>
                        <tr>
						<td><input type="checkbox" name="del[]" class="del" value="<?php echo $arr['id']; ?>"></td>
                          <td><?php echo $arr['id']; ?>
                          </td>
                          <td><?php echo $arr['name']; ?>
                          </td>
                          <td><?php echo $arr['email']; ?>
                          </td>
                          <td><?php echo $arr['password']; ?>
                          </td>
                          <td><img id="image" src="image/<?php echo @$arr['image'];?>" width="25px" height="25px" >
                          </td>
                          <td>
                          <button type="button" class="btn btn-primary deladdmin" value="<?php echo $arr['id']; ?>" data-toggle="modal" data-target="#">Delete</button>
                          <button type="button" class="btn btn-primary popup" data-toggle="modal" value="<?php echo $arr['id']; ?>"  data-target="#adminupdatemodel">Update</button>
						              </td>
                        </tr>
                        <?php } ?>
                    
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
    <?php include('footer.php'); ?>