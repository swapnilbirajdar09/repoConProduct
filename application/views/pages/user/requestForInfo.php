<title>Raise Query | Construction Manager</title>
<div class="right_col" role="main">
    <div class="row x_title">
        <div class="col-md-6">
            <h3><i class="fa fa-check"></i> Raise Query For Information(RFI) </h3>
        </div>
    </div> 
    <div class="w3-col l12 w3-padding-small page_title">
        <div class="w3-col l12 w3-margin-left w3-padding-small w3-center" id="message"></div>
        <form id="raiseQueryForm" name="raiseQueryForm" method="post">
            <div class="w3-col l12 s12 m12 w3-margin-top">
                <div class="col-lg-6 w3-padding-small" id="deletecat">
                    <div class="w3-col l12 s12 m12 w3-padding-bottom">
                        <label> Query Title: <font color ="red"><span id ="pname_star">*</span></font></label><br>
                        <font color ="red"><span id ="product_name_span"></span></font>
                        <input type="text" name="queryTitle" id="queryTitle" value="" placeholder="Query Title" class="w3-input w3-border w3-margin-bottom" required>
                    </div>                           
                    <!-- kk -->
                    <div class="w3-col l12 s12 m12 w3-padding-bottom">
                        <label> Query Description: <font color ="red"><span id ="pdescription_star">*</span></font></label><br>
                        <font color ="red"><span id ="product_description_span"></span></font>
                        <textarea class="w3-input w3-border w3-margin-bottom" placeholder="Query Description" name="queryDescription" id="queryDescription" rows="5" cols="50" style="resize: none;" required></textarea>
                    </div>
                    <!-- kk -->                            
                </div>
                <!-- ---div for images -->
                <div class="col-lg-6 w3-padding-tiny" id="deletecat">
                    <div class="w3-col l12 s12 m12">
                        <div class="w3-col l6 ">
                            <label>Images:</label>
                            <input type="file" name="prod_image[]" id="prod_image" class="w3-input w3-border" onchange="readURL(this);" required>
                        </div>
                        <div class="w3-col l6 w3-padding-small w3-margin-top">
                            <img src="" width="auto" id="adminImagePreview" height="150px" alt="Image will be displayed here once chosen." class=" w3-center img img-thumbnail">
                        </div>
                        <div class="w3-col l12 s12 m12" id="addedmore_imageDiv"></div>
                        <div class="w3-col l12 w3-margin-bottom">
                            <a id="add_moreimage" title="Add new Image" class="btn w3-text-red add_moreProduct w3-small w3-right w3-margin-top"><b>Add image <i class="fa fa-plus"></i></b>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- ---div for images -->
            </div>                   
            <div class="w3-col l12 w3-center" id="btnsubmit">
                <button id="raiseQry" type="submit" title="Raise Query" class="w3-margin w3-medium w3-button theme_bg">Raise Query</button>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        var max_fields = 5;
        var wrapper = $("#addedmore_imageDiv");
        var add_button = $("#add_moreimage");
        var x = 1;
        $(add_button).click(function (e) {
            e.preventDefault();
            if (x < max_fields) {
                x++;
                $(wrapper).append('<div>\n\
                    <div class="w3-col l12 s12 m12 w3-margin-top">\n\
                    <div class="w3-col l6 w3-padding-small">\n\
                    <label>Images:</label>\n\
                    <input type="file" name="prod_image[]" id="prod_image" class="w3-input w3-border" onchange="readURLNEW(this,' + x + ');" required>\n\
                    </div>\n\
                    <div class="w3-col l6 w3-padding-small">\n\
                    <img src="" width="auto" id="adminImagePreview_' + x + '" height="150px" alt=" Image Will Be Displayed Here Once Chosen." class=" w3-center img img-thumbnail">\n\
                    </div>\n\
                    <a href="#" class="delete btn w3-text-black w3-left w3-small" title="remove image">remove <i class="fa fa-remove"></i>\n\
                    </a>\n\
                    </div>\n\
                    </div>'); //add input box
            } else {
                $.alert('<label class="w3-label w3-text-red"><i class="fa fa-warning w3-xxlarge"></i> You Reached the maximum limit of adding ' + max_fields + ' fields</label>');   //alert when added more than 4 input fields
            }
        });
        $(wrapper).on("click", ".delete", function (e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        });
    });
</script>
<script>
    // ----function to preview selected image for profile------//
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#adminImagePreview').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
// ------------function preview image end------------------//
    function readURLNEW(input, id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#adminImagePreview_' + id).attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(function () {
        $("#raiseQueryForm").submit(function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>user/raisequery_rfi/raiseQuery",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $('#raiseQry').prop('disabled', true);
                },
                success: function (response) {
                    console.log(response);
                    //alert(response);
                    var data = JSON.parse(response);
                    $('#raiseQry').prop('disabled', false);
                    // response message
                    switch (data.status) {
                        case 'success':
                            $('#message').html(data.message);
                            break;
                        case 'error':
                            $('#message').html(data.message);
                            break;
                        case 'validation':
                            $('#message').html(data.message);
                            break;
                        default:
                            $('#message').html('<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><b>Error:</b> Something went wrong! Try refreshing page and Save again.</strong></div>window.setTimeout(function() {	$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove(); });}, 5000);');
                            break;
                    }
                },
                error: function (response) {
                    // Re_Enabling the Elements
                    $('#raiseQry').prop('disabled', false);
                    $('#message').html('<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><b>Error:</b> Something went wrong! Try refreshing page and Save again.</strong></div>window.setTimeout(function() {	$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove(); });}, 5000);');
                    setTimeout(function () {
                        $('.alert_message').fadeOut('fast');
                    }, 4000); // <-- time in milliseconds  
                }
            });
        });
    });
</script>