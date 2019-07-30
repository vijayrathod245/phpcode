<!DOCTYPE html>
<html>
<head>
    <title>Ajax Demo</title>
    <script src="jquery/jquery.js"></script>
    <script> 
        jQuery(document).ready(function(){
            jQuery('#submit').click(function(){
                var firstname = jQuery('#firstname').val();
                //alert(firstname);
               // var images = jQuery('#image').attr('src');
                //alert(images);
                var gender = jQuery('input[name="gender"]:checked').val();
                var hobby = new Array();
                jQuery('input[name="hobby"]:checked').each(function() 
			        {
				        hobby.push(this.value);
			        });
                //var image = jQuery('');
                //alert(hobby);
                clearInput();
                $.ajax({
                    type:'POST',
                    url:"result.php",
                    data:{
                        'action':'insert',
                        'firstname':firstname,
                        //'image':image,
                        'gender':gender,
                        'hobby':hobby
                    },
                    success: function(data){
                        jQuery('#myajax').html(data);
                    }

                });

            });
            
            });
              
        function clearInput() {
           // jQuery("#myForm :input").each( function() {
            jQuery(this).val('');
            });
        }

    </script>
</head>
<body>
    <div>
        <a href="view.php">View</a>
    </div>
    <div>
        <div id="myajax"></div>
        <form id="myForm">
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
            <div></div>
            <div><input type="button" name="submit" value="submit" id="submit">
                <!--<button name="submit" id="submit">Submit</button>-->
            </div>
        </form>
    </div>
</body>
</html>