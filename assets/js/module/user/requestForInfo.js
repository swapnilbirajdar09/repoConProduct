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

//--------update query
function updateQuery(query_id) {
    $.confirm({
        title: '<h4 class="w3-text-red">Please confirm the action!</h4><span class="w3-medium">Do you really want to Change Status Of this Query?</span>',
        content: '',
        type: 'red',
        buttons: {
            confirm: function () {
                $.ajax({
                    type: "GET",
                    url: BASE_URL + "modules/raisequery_rfi/updateQueryDetails",
                    data: {
                        query_id: query_id
                    },
                    cache: false,
                    success: function (response) {
                      // alert(response);
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
    var modal = $('#RFIModal_' + modal_id);
    modal.addClass('in');
    getComments(modal_id);
    $('.comment_msg').html('');

}

// get associated comments
function getComments(query_id) {
    $('#comment_list_' + query_id).html("<span class='w3-text-grey'><i class='fa fa-circle-o-notch fa-spin'></i> Loading comments. Please wait... </span>")
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
            $('#comment_list_' + query_id).html(response);
            // var data = JSON.parse(response);
        }
    });
}
//----------fun for add comment
function savecomment(query_id) {
    //alert(query_id);
    if (query_id == '') {
        $('.comment_msg').html('<p class="w3-red w3-padding-small w3-small">Warning! Invalid query! Reload the page to resolve the issue.</p>');
        return false;
    }
    var comment_posted = $('#comment_posted_' + query_id).val();
    if (comment_posted == '') {
        $('.comment_msg').html('<p class="w3-red w3-padding-small w3-small">Warning! Please Add Comment first..</p>');
        return false;
    }
    $.ajax({
        type: "POST",
        url: BASE_URL + "modules/raisequery_rfi/addComment",
        data: {
            query_id: query_id,
            comment_posted: comment_posted
        },
        return: false,
        beforeSend: function () {
            $('.comment_msg').html('');
            // $('#commentBtn').prop('disabled', true);
        },
        success: function (response) {
            //alert(response);
            $('#comment_posted_' + query_id).val('');
            var data = JSON.parse(response);
            $('#commentBtn').prop('disabled', false);
            // response message
            switch (data.status) {
                case 'success':
                    $('.comment_msg').html(data.message);
                    getComments(query_id);
                    // $('#comment_list').load(location.href + " #comment_list>*", "");
                    break;
                case 'error':
                    $('.comment_msg').html(data.message);
                    break;
                case 'validation':
                    $('.comment_msg').html(data.message);
                    break;
                default:
                    $('.comment_msg').html('<p class="w3-red w3-padding-small w3-small"><strong><b>Error:</b> Something went wrong! Try refreshing page and Save again.</strong></p>');
                    break;
            }
        },
        error: function (response) {
            // Re_Enabling the Elements
            $('#commentBtn').prop('disabled', false);
            $('.comment_msg').html('<p class="w3-red w3-padding-small w3-small"><strong><b>Error:</b> Something went wrong! Try refreshing page and Save again.</strong></p>');
            setTimeout(function () {
                $('.comment_msg').fadeOut('fast');
            }, 4000); // <-- time in milliseconds  
        }
    });
}
