var Appshowtimes = function() {

    // var loadComponents = function() {
    //     $("#loader").hide();
    //     $("banner").hide();
    //     $('body').find("#loading").hide();
    // }

    var AddShowtime = function() {
        var date = $('#date').val();
        var time = $("#time").val();
        var cinema_id = $("#cinema_id").val();
        var movie_id = $('#movie_id').val();
        var user_id = USER_ID;

        if (cinema_id.length < 1) {
            console.log("CInema field is required");
        } else if (movie_id.length < 1) {
            console.log("Movie is required");
        } else {
            $("#add_showtime").attr("disabled", true);
            $("#add_showtime").html("<i class='fa fa-refresh fa-spin'></i> Processing...");
            $.ajax({
                url: ADD_URL,
                method: "POST",
                data: {
                    '_token': TOKEN,
                    'movie_id': movie_id,
                    'cinema_id': cinema_id,
                    'date': date,
                    'time': time,
                    'user_id': user_id
                },
                success: function(rst) {
                    if (rst.type == "true") {
                        $("#add_showtime").attr("disabled", false);
                        $("#add_showtime").html("<i class='fa fa-check'></i> Add showtime!");
                        location.reload();
                    } else if (rst.type == "false") {
                        $("#add_showtime").attr("disabled", false);
                        $("#add_showtime").html(
                            "<i class='fa fa-warning fa-spin'></i> Failed. Try Again!"
                        );
                    }
                },
                error: function(alaxB, HTTerror, errorMsg) {
                    $("#add_showtime").attr("disabled", false);
                }
            });
        }
    }

    var EditShowtime = function(index) {
        $("#edit_showtime").modal();
        $("#loading").show();
        $("#showtime_details").hide();
        var showtime_id = $("#showtime_id" + index).val();

        $.ajax({
            url: GET_EDIT_INFO,
            method: "GET",
            data: {
                '_token': TOKEN,
                'showtime_id': showtime_id
            },
            success: function(rst) {
                $("#loading").hide();
                $("#showtime_details").fadeIn();
                $("#showtime_details").html(rst);
            },
            error: function(jqXHR, textStatus, errorMessage) {
                $("#loading").hide();
                $("#showtime_details").hide();
                $("#serverErrors1").show();
                console.log(errorMessage);
            }
        });
    }

    var UpdateShowtime = function() {
        var date = $('#date1').val();
        var time = $("#time1").val();
        var cinema_id = $("#cinema_id1").val();
        var movie_id = $('#movie_id1').val();
        var user_id = USER_ID;
        var slug = $("#slug").val();

        if (movie_id.length < 1) {
            console.log("Movie field is required");
        } else if (cinema_id.length < 1) {
            console.log("Cinema is required");
        } else {
            $("#edit-showtime").attr("disabled", true);
            $("#edit-showtime").html("<i class='fa fa-refresh fa-spin'></i> Processing...");
            $.ajax({
                url: UPDATE_URL,
                method: "PUT",
                data: {
                    '_token': TOKEN,
                    'movie_id': movie_id,
                    'cinema_id': cinema_id,
                    'date': date,
                    'time': time,
                    'id': slug,
                    'user_id': user_id
                },
                success: function(rst) {
                    if (rst.type == "true") {
                        $("#edit-showtime").attr("disabled", false);
                        $("#edit-showtime").html("<i class='fa fa-check'></i> Edit showtime!");
                        console.log(rst.msg);
                        location.reload();
                    } else if (rst.type == "false") {
                        $("#edit-showtime").attr("disabled", false);
                        $("#edit-showtime").html(
                            "<i class='fa fa-warning fa-spin'></i> Failed. Try Again!"
                        );
                        console.log(rst.msg);
                    }
                },
                error: function(alaxB, HTTerror, errorMsg) {
                    $("#edit-showtime").attr("disabled", false);
                    console.log(errorMsg);
                }
            });
        }
    }

    var DeleteShowtime = function(index) {
        $("#btn_showtime_delete" + index).attr("disabled", true);
        $("#btn_showtime_delete" + index).html("<i class='fa fa-refresh fa-spin'></i> Deleting this showtime...");
        //deleting showtime
        $.ajax({
            url: $("#btn_showtime_delete" + index).data("href"),
            method: "GET",
            data: {},
            success: function(rst) {
                if (rst.type == "true") {
                    $("#btn_showtime_delete" + index).attr("disabled", false);
                    $("#btn_showtime_delete" + index).html("<i class='fa fa-check'></i> deleted.");
                    console.log(rst.msg);
                    location.reload();
                } else if (rst.type == "false") {
                    $("#btn_showtime_delete").attr("disabled", false);
                    $("#btn_showtime_delete").html(
                        "<i class='fa fa-warning'></i> Failed! Try Again."
                    );
                    console.log(rst.msg);
                }
            },
            error: function(alaxB, HTTerror, errorMsg) {
                $("#btn_showtime_delete").attr("disabled", false);
                console.log(errorMsg);
            }
        });
    }

    var AddshowtimeBanner = function() {
        var extension = $('#showtime_banner').val().split('.').pop().toLowerCase();
        if ($.inArray(extension, ['jpg', 'jpeg', 'png']) == -1) {
            console.log("This extension is not supported");
            $('#showtime_banner').val("");
        } else {
            $("#upload_showtime_image").attr("disabled", true);
            $("#upload_showtime_image").html("<i class='fa fa-refresh fa-spin'></i> Processing...");
            var file_data = $("#showtime_banner").prop("files")[0];

            var form_data = new FormData();
            form_data.append('image', file_data);
            form_data.append('_token', TOKEN);
            form_data.append('showtime_id', showtime_id);
            $.ajax({
                url: UploadshowtimeBanner, // point to server-side PHP script
                data: form_data,
                type: "POST",
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false,
                success: function(rst) {
                    $("#upload_showtime_image").attr("disabled", false);
                    $("#upload_showtime_image").html(
                        "<i class='fa fa-check'></i> Submit!"
                    );
                    console.log(rst.msg);
                    location.reload();
                },
                error: function(alaxB, HTTerror, errorMsg) {
                    console.log(errorMsg);
                }
            });
        }
    }

    return {
        init: function() {
            // loadComponents();

            $("#add_showtime").on("click", function() {
                AddShowtime();
            });

            $("body").find("#showtime_details").on("click ", "#edit-showtime", function() {
                UpdateShowtime();
            });

            $("body").find("table.showtime tbody tr")
                .each(function(index) {
                    $("#edit" + index).on("click", function() {
                        EditShowtime(index);
                    });
                });

            $("body").find("table.showtime tbody tr")
                .each(function(index) {
                    $("#btn_showtime_delete" + index).on("click", function() {
                        $("#serverErrors").html("");
                        DeleteShowtime(index);
                    });
                });
            $("#upload_showtime_image").on("click", function() {
                AddshowtimeBanner();
            });

            $("#showtime_banner").on("change", function() {
                $("#banner").show();
            })
        }
    }
}();

$(document).ready(function() {
    Appshowtimes.init();
});