<?php
include('db.php');

$per_page=5;
if (isset($_GET["page"])) {

$page = $_GET["page"];

}

else {

$page=1;

}

// Page will start from 0 and Multiple by Per Page
$start_from = ($page-1) * $per_page;


$qry_sel = "select * from student LIMIT $start_from, $per_page";
$res = mysqli_query($conn, $qry_sel);
$arr = mysqli_fetch_array($res);

?>
<!--<div id="target-content" >loading...</div>-->
<!DOCTYPE html>
<html>
<head>
    <title>Ajax View</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <script src="jquery/jquery.js"></script>
    <script>
        jQuery(document).ready(function(){
            jQuery('.del').click(function(){
                var id = jQuery(this).attr("value");
                //alert(id);

                $.ajax({
                    type:'POST',
                    url: "delete.php",
                    data:{
                        'action':'delete',
                        'id':id,
                    },
                    success: function(data){
                        jQuery('#delete').html(data);
                    }
                });
            });

            jQuery('.popup').click(function(){
                var id = jQuery(this).attr('value');
               // alert(id);
               $.ajax({
                    type: 'POST',
                    url: "select.php",
                    data:{
                        'action':'select',
                        'id':id
                    },
                    dataType:"JSON",
                    success: function(array){
                        jQuery('#firstname').val(array['firstname']);
                        if (array.gender == 'male')
                        jQuery('#ex1').find(':radio[name=gender][value="male"]').prop('checked', true);
                         else
                         jQuery('#ex1').find(':radio[name=gender][value="female"]').prop('checked', true);
                    
                        //hobby//
                        jQuery("form input:checkbox").each(function(){
                            if(jQuery.inArray(jQuery(this).attr('value'), array.hobby )!=-1)
                        jQuery(this).prop('checked', true);
                            else
                        jQuery(this).prop('checked', false);
                        //jQuery('#id').val(array.id);
                        //ejQuery('#id').val(array.id);
                            });
                        }
               });
            });


            jQuery('#update').click(function(){
                //alert('Hello');
                var id=jQuery('#id').val();
                //alert(id);
                var firstname = jQuery('#firstname').val();
                var gender = jQuery('input[name="gender"]:checked').val();
                var hobby = new Array();
			    jQuery('input[name="hobby"]:checked').each(function() 
			    {
				    hobby.push(this.value);
			    });
                //alert(hobby);
               $.ajax({
                   type:'POST',
                   url:"update.php",
                   data:{
                       'action':'update',
                       'id':id,
                       'firstname':firstname,
                       'gender':gender,
                       'hobby':hobby
                   },
                   success: function(data){
                    //jQuery('#id').val('');
                    jQuery("#firstname").val('');
					jQuery('input[name="gender"]').attr('checked',false);
					jQuery('input[name="hobby"]').attr('checked',false);
                   }
               });
            });
            
        });  
    </script>
</head>
<body>
    
    <div id="delete">
    <div>
        <a href="demo.php">Add</a>
    </div>
    <table border="1">
        <tr>
            <td>Id</td>
            <td>FirstName</td>
            <td>Image</td>
            <td>Gender</td>
            <td>Hobby</td>
            <td>Action</td>
        </tr>
        <?php 
            while($arr = mysqli_fetch_array($res)){?>
        <tr>
            <td><?php echo $arr['id']; ?></td>
            <td><?php echo $arr['firstname']; ?></td>
            <td><?php echo $arr['image']; ?></td>
            <td><?php echo $arr['gender']; ?></td>
            <td><?php echo $arr['hobby']; ?></td>
            <td><button class="del" value="<?php echo $arr['id']; ?>">Delete</button>||
            <a href="#ex1" class="popup" id="" value="<?php echo $arr['id']; ?>" rel="modal:open">Update</a></td>
        </tr>
            <?php } ?>
    </table>
         <div class="page-info">
                    <?php
                        $qry_sel = "select * from student";
                        $res = mysqli_query($conn, $qry_sel);
                        
                        $total_record = mysqli_num_rows($res);
                        $total_pages = ceil($total_record / $per_page);

                        //Going to first page
                        echo "<h3><a href='view.php?page=1' id='pagination'>".'First Page'."</a> ";

                        for ($i=1; $i<=$total_pages; $i++) {

                        echo "<a href='view.php?page=".$i."' id='pagination'>".$i."</a> ";
                        };
                        // Going to last page
                        echo "<a href='view.php?page=$total_pages' id='pagination'>".'Last Page'."</a></h3>";

                    ?>
                </div>


    </div>

        <div id="ex1" class="modal" hidden="">
            <!--<p>Thanks for clicking. That felt good.</p>
            <a href="#" rel="modal:close">Close</a>-->
            <form name="frm" id="frm">



            <div>FirstName</div>
            <div><input type="text" name="firstname" id="firstname"/></div>
            <div>Image</div>
            <div><input type="file" name="image" id="image"/></div>
            <div>Gender</div>
            <div><input type="radio" name="gender" value="male" id="gender"/>Male
            <input type="radio" name="gender" value="female" id="gender"/>Female</div>
            <div>Hobby</div>
            <div><input type="checkbox" name="hobby" id="hobby" value="cricket"/>Cricket
            <input type="checkbox" name="hobby" id="hobby" value="football" />Football
            <input type="checkbox" name="hobby" id="hobby" value="music"/>Music</div>
            <div><input type="hidden" name="id" id="id" value=""></div>
            <div><input type="button" name="update" value="update" id="update"></div>
        </form>
        </div>

</body>
</html>