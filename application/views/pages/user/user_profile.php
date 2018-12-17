
<div class="right_col" role="main">
    <!-- top tiles -->
   
    <!-- /top tiles -->


     <div class="w3-col l12 w3-margin-left w3-padding-small w3-center" style="margin:10px;" id="message"></div>
    <!-- Div for Add Plant-->
    <div class="row" style="padding-left:10px;">
       <div class="col-md-4 col-sm-12 col-xs-12 w3-margin">
                        <label><i class="fa fa-envelope"></i> SetUp Email-ID</label><br>
                        <form id="updateEmail">
                            <div class="w3-col l8 w3-padding-right w3-margin-bottom">
                                <input type="email" name="email" value="<?php echo $userrole_details['status_message'][0]['user_email']; ?>" placeholder="Enter Email-ID here..." id="admin_email" class="w3-input" required>
                            </div>
                            <div class="w3-col l4">
                                <button type="submit" class="w3-button theme_bg">Update Email-ID</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12 w3-margin">
                        <label><i class="fa fa-key"></i> Update Password</label><br>
                       
                        <form id="updatePass">
                            <div class="w3-col l8 w3-padding-right w3-margin-bottom">
                                <input type="text" name="pass" value="<?php echo $userrole_details['status_message'][0]['password']; ?>" placeholder="Enter Password here..." id="admin_pass" class="w3-input" required>
                            </div>
                            <div class="w3-col l4">
                                <button type="submit" class="w3-button theme_bg">Update Password</button>
                            </div>
                        </form>
                    </div>


    </div>
      <div class="row" style="padding-left:10px;">
       <div class="col-md-4 col-sm-12 col-xs-12 w3-margin">
                        <label><i class="fa fa-user"></i> Update Username</label><br>
                        <form id="updateUname">
                            <div class="w3-col l8 w3-padding-right w3-margin-bottom">
                                <input type="text" name="uname" value="<?php echo $userrole_details['status_message'][0]['user_name']; ?>" placeholder="Enter UserName here..." id="admin_email" class="w3-input" required>
                            </div>
                            <div class="w3-col l4">
                                <button type="submit" class="w3-button theme_bg">Update Username</button>
                            </div>
                        </form>
                    </div>
                   


    </div>
</div>

       
<!-- /page content -->
<!--  script to update email id   -->
<script>
	$(function(){
		$("#updateEmail").submit(function(){
			dataString = $("#updateEmail").serialize();
			//alert(dataString);
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>user/user_profile/updateUserRoleEmail",
				data: dataString,
           return: false,  //stop the actual form post !important!

          success: function(response)
           {
           	data = JSON.parse(response)
            $('#message').html(data.message);                     
           }
         });
         return false;  //stop the actual form post !important!

     });
	});
</script>
<!-- script ends here -->
<!--  script to update Password   -->
<script>
    $(function(){
        $("#updatePass").submit(function(){
            dataString = $("#updatePass").serialize();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>user/user_profile/updateUserRolePass",
                data: dataString,
                return: false,  //stop the actual form post !important!

           success: function(response)
           {
           	data = JSON.parse(response)
            $('#message').html(data.message);                     
           }

       });

         return false;  //stop the actual form post !important!

     });
    });
</script>
<!-- script ends here -->
<script>
	$(function(){
		$("#updateUname").submit(function(){
			dataString = $("#updateUname").serialize();

			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>user/user_profile/updateUserRoleUname",
				data: dataString,
           return: false,  //stop the actual form post !important!

          success: function(response)
           {
           	data = JSON.parse(response)
            $('#message').html(data.message);                     
           }
       });

         return false;  //stop the actual form post !important!

     });
	});
</script>