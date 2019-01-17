var AppCinemas = function() {

    // var loadComponents = function() {
    //     $("#loader").hide();
    //     $("banner").hide();
    //     $('body').find("#loading").hide();
    // }

    var AddCinema = function() {
        var name = $('#name').val();
        var location = $("#location").val();
        var user_id = USER_ID;
        var slug = SLUG;

        if (name.length < 1) {
            console.log("name field is required");
        } else if (location.length < 1) {
            console.log("location is required");
        } else {
            $("#add_cinema").attr("disabled", true);
            $("#add_cinema").html("<i class='fa fa-refresh fa-spin'></i> Processing...");
            $.ajax({
                url: ADD_URL,
                method: "POST",
                data: {
                    '_token': TOKEN,
                    'name': name,
                    'location': location,
                    'slug': slug,
                    'user_id': user_id
                },
                success: function(rst) {
                    if (rst.type == "true") {
                        $("#add_cinema").attr("disabled", false);
                        $("#add_cinema").html("<i class='fa fa-check'></i> Add Cinema!");
                        location.reload();
                    } else if (rst.type == "false") {
                        $("#add_cinema").attr("disabled", false);
                        $("#add_cinema").html(
                            "<i class='fa fa-warning fa-spin'></i> Failed. Try Again!"
                        );
                    }
                },
                error: function(alaxB, HTTerror, errorMsg) {
                    $("#add_cinema").attr("disabled", false);
                }
            });
        }
    }

    var EditCinema = function(index) {
        $("#edit_cinema").modal();
        $("#loading").show();
        $("#cinema_details").hide();
        var cinema_id = $("#cinema_id" + index).val();

        $.ajax({
            url: GET_EDIT_INFO,
            method: "GET",
            data: {
                '_token': TOKEN,
                'cinema_id': cinema_id
            },
            success: function(rst) {
                $("#loading").hide();
                $("#cinema_details").fadeIn();
                $("#cinema_details").html(rst);
            },
            error: function(jqXHR, textStatus, errorMessage) {
                $("#loading").hide();
                $("#cinema_details").hide();
                $("#serverErrors1").show();
                console.log(errorMessage);
            }
        });
    }

    var UpdateCinema = function() {
        var name = $('#name1').val();
        var location = $("#location1").val();
        var user_id = USER_ID;
        var slug = $("#slug").val();

        if (name.length < 1) {
            console.log("name field is required");
        } else if (location.length < 1) {
            console.log("location is required");
        } else {
            $("#edit-cinema").attr("disabled", true);
            $("#edit-cinema").html("<i class='fa fa-refresh fa-spin'></i> Processing...");
            $.ajax({
                url: UPDATE_URL,
                method: "PUT",
                data: {
                    '_token': TOKEN,
                    'name': name,
                    'location': location,
                    'id': slug,
                    'user_id': user_id
                },
                success: function(rst) {
                    if (rst.type == "true") {
                        $("#edit-cinema").attr("disabled", false);
                        $("#edit-cinema").html("<i class='fa fa-check'></i> Edit Cinema!");
                        console.log(rst.msg);
                        location.reload();
                    } else if (rst.type == "false") {
                        $("#edit-cinema").attr("disabled", false);
                        $("#edit-cinema").html(
                            "<i class='fa fa-warning fa-spin'></i> Failed. Try Again!"
                        );
                        console.log(rst.msg);
                    }
                },
                error: function(alaxB, HTTerror, errorMsg) {
                    $("#edit-cinema").attr("disabled", false);
                    console.log(errorMsg);
                }
            });
        }
    }

    var DeleteCinema = function(index) {
        $("#btn_cinema_delete" + index).attr("disabled", true);
        $("#btn_cinema_delete" + index).html("<i class='fa fa-refresh fa-spin'></i> Deleting this cinema...");
        //deleting cinema
        $.ajax({
            url: $("#btn_cinema_delete" + index).data("href"),
            method: "GET",
            data: {},
            success: function(rst) {
                if (rst.type == "true") {
                    $("#btn_cinema_delete" + index).attr("disabled", false);
                    $("#btn_cinema_delete" + index).html("<i class='fa fa-check'></i> deleted.");
                    console.log(rst.msg);
                    location.reload();
                } else if (rst.type == "false") {
                    $("#btn_cinema_delete").attr("disabled", false);
                    $("#btn_cinema_delete").html(
                        "<i class='fa fa-warning'></i> Failed! Try Again."
                    );
                    console.log(rst.msg);
                }
            },
            error: function(alaxB, HTTerror, errorMsg) {
                $("#btn_cinema_delete").attr("disabled", false);
                console.log(errorMsg);
            }
        });
    }

    var AddcinemaBanner = function() {
        var extension = $('#cinema_banner').val().split('.').pop().toLowerCase();
        if ($.inArray(extension, ['jpg', 'jpeg', 'png']) == -1) {
            console.log("This extension is not supported");
            $('#cinema_banner').val("");
        } else {
            $("#upload_cinema_image").attr("disabled", true);
            $("#upload_cinema_image").html("<i class='fa fa-refresh fa-spin'></i> Processing...");
            var file_data = $("#cinema_banner").prop("files")[0];

            var form_data = new FormData();
            form_data.append('image', file_data);
            form_data.append('_token', TOKEN);
            form_data.append('cinema_id', cinema_id);
            $.ajax({
                url: UploadcinemaBanner, // point to server-side PHP script
                data: form_data,
                type: "POST",
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false,
                success: function(rst) {
                    $("#upload_cinema_image").attr("disabled", false);
                    $("#upload_cinema_image").html(
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

            $("#add_cinema").on("click", function() {
                AddCinema();
            });

            $("body").find("#cinema_details").on("click ", "#edit-cinema", function() {
                UpdateCinema();
            });

            $("body").find("table.cinema tbody tr")
                .each(function(index) {
                    $("#edit" + index).on("click", function() {
                        EditCinema(index);
                    });
                });

            $("body").find("table.cinema tbody tr")
                .each(function(index) {
                    $("#btn_cinema_delete" + index).on("click", function() {
                        $("#serverErrors").html("");
                        DeleteCinema(index);
                    });
                });
            $("#upload_cinema_image").on("click", function() {
                AddcinemaBanner();
            });

            $("#cinema_banner").on("change", function() {
                $("#banner").show();
            })
        }
    }
}();

$(document).ready(function() {
    AppCinemas.init();
});