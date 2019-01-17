var AppMovies = function() {

    // var loadComponents = function() {
    //     $("#loader").hide();
    //     $("banner").hide();
    //     $('body').find("#loading").hide();
    // }

    var AddMovie = function() {
        var title = $('#title').val();
        var release_date = $("#release_date").val();
        var user_id = USER_ID;
        var slug = SLUG;
        var genre = $("#genre").val();
        var duration = $("#duration").val();
        var language = $("#language").val();
        var description = $("#description").val();

        if (title.length < 1) {
            console.log("title field is required");
        } else if (release_date.length < 1) {
            console.log("release_date is required");
        } else {
            $("#add_movies").attr("disabled", true);
            $("#add_movies").html("<i class='fa fa-refresh fa-spin'></i> Processing...");
            $.ajax({
                url: ADD_URL,
                method: "POST",
                data: {
                    '_token': TOKEN,
                    'title': title,
                    'release_date': release_date,
                    'genre': genre,
                    'slug': slug,
                    'user_id': user_id,
                    'duration': duration,
                    'language': language,
                    'description': description
                },
                success: function(rst) {
                    if (rst.type == "true") {
                        $("#add_movies").attr("disabled", false);
                        $("#add_movies").html("<i class='fa fa-check'></i> Add Movie!");
                    } else if (rst.type == "false") {
                        $("#add_movies").attr("disabled", false);
                        $("#add_movies").html(
                            "<i class='fa fa-warning fa-spin'></i> Failed. Try Again!"
                        );
                    }
                },
                error: function(alaxB, HTTerror, errorMsg) {
                    $("#add_movies").attr("disabled", false);
                }
            });
        }
    }

    var EditMovie = function(index) {
        $("#edit_movie").modal();
        $("#loading").show();
        $("#movie_details").hide();
        var movie_id = $("#movie_id" + index).val();

        $.ajax({
            url: GET_EDIT_INFO,
            method: "GET",
            data: {
                '_token': TOKEN,
                'movie_id': movie_id
            },
            success: function(rst) {
                $("#loading").hide();
                $("#movie_details").fadeIn();
                $("#movie_details").html(rst);
            },
            error: function(jqXHR, textStatus, errorMessage) {
                $("#loading").hide();
                $("#movie_details").hide();
                $("#serverErrors1").show();
                console.log(errorMessage);
            }
        });
    }

    var UpdateMovie = function() {
        var title = $('#title1').val();
        var release_date = $("#release_date1").val();
        var user_id = USER_ID;
        var slug = $("#slug").val();
        var genre = $("#genre1").val();
        var duration = $("#duration1").val();
        var language = $("#language1").val();
        var description = $("#description1").val();

        if (title.length < 1) {
            console.log("Title field is required");
        } else if (release_date.length < 1) {
            console.log("Release is required");
        } else {
            $("#edit-movie").attr("disabled", true);
            $("#edit-movie").html("<i class='fa fa-refresh fa-spin'></i> Processing...");
            $.ajax({
                url: UPDATE_URL,
                method: "PUT",
                data: {
                    '_token': TOKEN,
                    'title': title,
                    'release_date': release_date,
                    'genre': genre,
                    'id': slug,
                    'user_id': user_id,
                    'duration': duration,
                    'language': language,
                    'description': description
                },
                success: function(rst) {
                    if (rst.type == "true") {
                        $("#edit-movie").attr("disabled", false);
                        $("#edit-movie").html("<i class='fa fa-check'></i> Edit movie!");
                        console.log(rst.msg);
                        location.reload();
                    } else if (rst.type == "false") {
                        $("#edit-movie").attr("disabled", false);
                        $("#edit-movie").html(
                            "<i class='fa fa-warning fa-spin'></i> Failed. Try Again!"
                        );
                        console.log(rst.msg);
                    }
                },
                error: function(alaxB, HTTerror, errorMsg) {
                    $("#add_movie").attr("disabled", false);
                    console.log(errorMsg);
                }
            });
        }
    }

    var DeleteMovie = function(index) {
        $("#btn_movie_delete" + index).attr("disabled", true);
        $("#btn_movie_delete" + index).html("<i class='fa fa-refresh fa-spin'></i> Deleting this movie...");
        //deleting movie
        $.ajax({
            url: $("#btn_movie_delete" + index).data("href"),
            method: "GET",
            data: {},
            success: function(rst) {
                if (rst.type == "true") {
                    $("#btn_movie_delete" + index).attr("disabled", false);
                    $("#btn_movie_delete" + index).html("<i class='fa fa-check'></i> deleted.");
                    console.log(rst.msg);
                    location.reload();
                } else if (rst.type == "false") {
                    $("#btn_movie_delete").attr("disabled", false);
                    $("#btn_movie_delete").html(
                        "<i class='fa fa-warning'></i> Failed! Try Again."
                    );
                    console.log(rst.msg);
                }
            },
            error: function(alaxB, HTTerror, errorMsg) {
                $("#add_movie").attr("disabled", false);
                console.log(errorMsg);
            }
        });
    }

    var AddMovieBanner = function() {
        var extension = $('#movie_banner').val().split('.').pop().toLowerCase();
        if ($.inArray(extension, ['jpg', 'jpeg', 'png']) == -1) {
            console.log("This extension is not supported");
            $('#movie_banner').val("");
        } else {
            $("#upload_movie_image").attr("disabled", true);
            $("#upload_movie_image").html("<i class='fa fa-refresh fa-spin'></i> Processing...");
            var file_data = $("#movie_banner").prop("files")[0];

            var form_data = new FormData();
            form_data.append('image', file_data);
            form_data.append('_token', TOKEN);
            form_data.append('movie_id', movie_id);
            $.ajax({
                url: UploadMovieBanner, // point to server-side PHP script
                data: form_data,
                type: "POST",
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false,
                success: function(rst) {
                    $("#upload_movie_image").attr("disabled", false);
                    $("#upload_movie_image").html(
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

            $("#add_movies").on("click", function() {
                AddMovie();
            });

            $("body").find("#movie_details").on("click ", "#edit-movie", function() {
                UpdateMovie();
            });

            $("body").find("table.movies tbody tr")
                .each(function(index) {
                    $("#edit" + index).on("click", function() {
                        EditMovie(index);
                    });
                });

            $("body").find("table.table.table-striped.table-hover.table-bordered.movies tbody tr")
                .each(function(index) {
                    $("#btn_movie_delete" + index).on("click", function() {
                        $("#serverErrors").html("");
                        DeleteMovie(index);
                    });
                });
            $("#upload_movie_image").on("click", function() {
                AddMovieBanner();
            });

            $("#movie_banner").on("change", function() {
                $("#banner").show();
            })
        }
    }
}();

$(document).ready(function() {
    AppMovies.init();
});