<title>Construction Manager | Create Project</title>
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="">
                <div class="row x_title">
                    <div class="col-md-6">
                        <h3><i class="fa fa-plus"></i> Create Project</h3>
                    </div>
                </div>             
                <form id="create_project" name="create_project" method="post">
                    <div class="w3-col l12 page_title">
                        <div class="w3-col l12 w3-margin-left w3-padding-small w3-center" id="message"></div>
                        <!-- Alert for Validating Ajax Profile Edit Section -->
                        <div class="col-lg-3 col-md-4 alert_message" id="ajax_validation_alert" style="display: none; position: fixed; top: 15px; right: 0; z-index: 9999">
                            <div class="alert alert-warning  fade show alert-dismissible" role="alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <span class="ajax_validation_alert"></span>
                            </div>
                        </div>
                        <!-- Alert for Validating Ajax Profile Edit Section -->
                        <!-- Alerts for Member actions -->
                        <div class="col-lg-3 col-md-4 alert_message" id="ajax_success_alert" style="display: none; position: fixed; top: 15px; right: 0; z-index: 9999">
                            <div class="alert alert-success  fade show alert-dismissible" role="alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <!-- Success Alert Content -->
                                <span class="ajax_success_alert"></span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 alert_message" id="ajax_danger_alert" style="display: none; position: fixed; top: 15px; right: 0; z-index: 9999">
                            <div class="alert alert-danger  fade show alert-dismissible" role="alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <!-- Success Alert Content -->
                                <span class="ajax_danger_alert"></span>
                            </div>
                        </div>
                        <!-- warning alerts -->
                        <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                            <div class="form-group">
                                <label for="customer_name">Project Name <b class="w3-text-red w3-medium">*</b> </label>
                                <input type="text" class="form-control" id="projectName" name="projectName" placeholder="Enter Project Name Here" required>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom" >
                            <div class="form-group w3-col l12">
                                <label for="stock_plant">Project Description <b class="w3-text-red w3-medium">*</b> </label>
                                <textarea class="w3-input w3-border w3-margin-bottom" placeholder="Enter Project  Description Here" name="projectDesc" id="projectDesc" rows="5" cols="50" style="resize: none;" required></textarea>
                            </div>                          
                        </div> 
                     <div class="w3-col l12 form-group w3-center w3-padding-top">
                            <button id="project_done" class="w3-button w3-margin-top theme_bg" type="submit" > Create Project </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      </div>
</div>
<script>
	$(function(){
		$("#create_project").submit(function(){
			dataString = $("#create_project").serialize();
			alert(dataString);
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>user/create_project/create_Newproject",
				data: dataString,
           return: false,  //stop the actual form post !important!

           success: function(data)
           {
           	alert(data);
           	$.alert(data);                       
           }
         });
         return false;  //stop the actual form post !important!

     });
	});
</script>
