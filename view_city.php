<?php 
    include('header.php'); 

    $qry_sel_state = "select state.statename,city. * from city JOIN state ON state.state_id=city.states_id";
    $res_sel = mysqli_query($conn, $qry_sel_state);

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
						<th><input type="checkbox" id="checkAl"> Checked All <button type="button" name="btn_delete" id="btn_delete" class="multi_delete">Delete</button></th>
                          <th>Id
                          </th>
						  <th>State Name
                          </th>
                          <th>City Name
                          </th>
                        
                          <th>Action
                          </th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
						<th>Delete
                          </th>
                          <th>Id
                          </th>
						  <th>State Name
                          </th>
                          <th>City Name
                          </th>
                          
                          <th>Action
                          </th>
                        </tr>
                      </tfoot>
                      <?php while($arr = mysqli_fetch_array($res_sel)){ ?>
                        <tr data-row-id="<?php echo $arr['id']; ?>">
						  <td>
							<input type="checkbox" id="checkItem" class="sub_chk" name="allcheckbox" data-row-id="<?php echo $arr['id']; ?>" />
						  </td>
                          <td><?php echo $arr['city_id']; ?>
                          </td>
						  <td><?php echo $arr['statename']; ?>
                          </td>
                          <td><?php echo $arr['cityname']; ?>
                          </td>
                      
                          <td>
						  <button type="button" class="btn btn-primary action" name="action" value="<?php echo $arr['id']; ?>" data-toggle="modal" data-target="#">Action</button>
                          <button type="button" class="btn btn-primary del" value="<?php echo $arr['id']; ?>" data-toggle="modal" data-target="#">Delete</button>
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