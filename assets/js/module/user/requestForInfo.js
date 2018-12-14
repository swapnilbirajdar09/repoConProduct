function removeQuery(query_id) {
    $.confirm({
        title: '<h4 class="w3-text-red">Please confirm the action!</h4><span class="w3-medium">Do you really want to Delete This Query?</span>',
        content: '',
        type: 'red',
        buttons: {
            confirm: function () {
                $.ajax({
                    type: "GET",
                    url: BASE_URL + "modules/raisequery_rfi/removeQuery",
                    data: {
                        query_id: query_id
                    },
                    cache: false,
                    success: function (response) {
                        //alert(response);
                        var data = JSON.parse(response);
                        switch (data.status) {
                            case 'success':
                            $('#message').html(data.message);
                            break;
                            case 'error':
                            $('#message').html(data.message);
                            break;
                            default:
                            $('#message').html('<div class="alert alert-danger alert-dismissible" style="margin-bottom:5px"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><b>Error:</b> Something went wrong! Try refreshing page and Save again.!</strong></div>');
                            setTimeout(function () {
                                $('.alert_message').fadeOut('fast');
                                }, 8000); // <-- time in milliseconds
                            break;
                        }
                    }
                });
            },
            cancel: function () {
            }
        }
    });
}

// ----function to open modal product------//
function openHelp(modal_id) {
  var modal=$('#RFIModal_'+modal_id);
  modal.addClass('in');
  getComments(modal_id);
}

// get associated comments
function getComments(query_id) {
    $('#comment_list').html("<span class='w3-text-grey'><i class='fa fa-circle-o-notch fa-spin'></i> Loading comments. Please wait... </span>")
    $.ajax({
        type: "GET",
        url: BASE_URL + "modules/raisequery_rfi/getQueryComments",
        data: {
            query_id: query_id
        },
        cache: false,
        success: function (response) {
        //alert(response);
        // console.log(response);
        $('#comment_list').html(response);
        // var data = JSON.parse(response);
        
    }
});
}



// post comment
$(function () {
    $(".rfiReply_form").submit(function (e) {
        e.preventDefault();
        dataString = $(".rfiReply_form").serialize();
        var id=$('#replyfor').val();
        if(id==''){
            $('#comment_msg').html('<p class="w3-red w3-padding-small w3-small">Warning! Invalid query! Reload the page to resolve the issue.</p>');
            return false;
        }
        $.ajax({
            type: "POST",
            url: BASE_URL+"modules/raisequery_rfi/postComment",
            data: dataString,
            return: false,
            beforeSend: function () {
                $('#comment_msg').html('');
                // $('#commentBtn').prop('disabled', true);
            },
            success: function (response) {
                alert(response);
                console.log(response);return false;
                    //alert(response);
                    var data = JSON.parse(response);
                    $('#commentBtn').prop('disabled', false);
                    // response message
                    switch (data.status) {
                        case 'success':
                        $('#comment_msg').html(data.message);
                        getComments(id);
                        // $('#comment_list').load(location.href + " #comment_list>*", "");
                        break;
                        case 'error':
                        $('#comment_msg').html(data.message);
                        break;
                        case 'validation':
                        $('#comment_msg').html(data.message);
                        break;
                        default:
                        $('#comment_msg').html('<p class="w3-red w3-padding-small w3-small"><strong><b>Error:</b> Something went wrong! Try refreshing page and Save again.</strong></p>');
                        break;
                    }
                },
                error: function (response) {
                    // Re_Enabling the Elements
                    $('#commentBtn').prop('disabled', false);
                    $('#comment_msg').html('<p class="w3-red w3-padding-small w3-small"><strong><b>Error:</b> Something went wrong! Try refreshing page and Save again.</strong></p>');
                    setTimeout(function () {
                        $('#comment_msg').fadeOut('fast');
                    }, 4000); // <-- time in milliseconds  
                }
            });
    });
});