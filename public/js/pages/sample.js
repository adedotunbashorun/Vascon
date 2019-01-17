var AppEvents = function() {

    var loadComponents = function() {
        $("#loader").hide();
        $("banner").hide();
        $('body').find("#loading").hide();
    }

    var AddEvent = function() {
        var name = $('#name').val();
        var description = $("#description").val();
        var host = $("#host").val();
        var location = $("#location").val();
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();

        if (name.length < 1) {
            toastr.error("Name field is required");
        } else if (description.length < 1) {
            toastr.error("Description is required");
        } else {
            $("#add_event").attr("disabled", true);
            $("#add_event").html("<i class='fa fa-refresh fa-spin'></i> Processing...");
            $.ajax({
                url: INSERT,
                method: "POST",
                data: {
                    '_token': TOKEN,
                    'name': name,
                    'description': description,
                    'host': host,
                    'location': location,
                    'start_date': start_date,
                    'end_date': end_date
                },
                success: function(rst) {
                    if (rst.type == "true") {
                        $("#add_event").attr("disabled", false);
                        $("#add_event").html("<i class='fa fa-check'></i> Add Event!");
                        toastr.success(rst.msg);
                        location.reload();
                    } else if (rst.type == "false") {
                        $("#add_event").attr("disabled", false);
                        $("#add_event").html(
                            "<i class='fa fa-warning fa-spin'></i> Failed. Try Again!"
                        );
                        toastr.warning(rst.msg);
                    }
                },
                error: function(alaxB, HTTerror, errorMsg) {
                    $("#add_event").attr("disabled", false);
                    toastr.error(errorMsg);
                }
            });
        }
    }

    var EditEvent = function(index) {
        $("#edit_event").modal();
        $("#loading").show();
        $("#event_details").hide();
        var event_id = $("#event_id" + index).val();

        $.ajax({
            url: GET_EDIT_INFO,
            method: "GET",
            data: {
                '_token': TOKEN,
                'event_id': event_id
            },
            success: function(rst) {
                $("#loading").hide();
                $("#event_details").fadeIn();
                $("#event_details").html(rst);
            },
            error: function(jqXHR, textStatus, errorMessage) {
                $("#loading").hide();
                $("#event_details").hide();
                $("#serverErrors1").show();
                toastr.error(errorMessage);
            }
        });
    }

    var UpdateEvent = function() {
        var name = $('#name1').val();
        var slug = $("#slug").val();
        var description = $("#description1").val();
        var host = $("#host1").val();
        var location = $("#location1").val();
        var start_date = $("#start_date1").val();
        var end_date = $("#end_date1").val();

        if (name.length < 1) {
            toastr.error("Name field is required");
        } else if (description.length < 1) {
            toastr.error("Description is required");
        } else {
            $("#edit-event").attr("disabled", true);
            $("#edit-event").html("<i class='fa fa-refresh fa-spin'></i> Processing...");
            $.ajax({
                url: UPDATE_URL,
                method: "POST",
                data: {
                    '_token': TOKEN,
                    'id': slug,
                    'name': name,
                    'description': description,
                    'host': host,
                    'location': location,
                    'start_date': start_date,
                    'end_date': end_date
                },
                success: function(rst) {
                    if (rst.type == "true") {
                        $("#edit-event").attr("disabled", false);
                        $("#edit-event").html("<i class='fa fa-check'></i> Edit Event!");
                        toastr.success(rst.msg);
                        location.reload();
                    } else if (rst.type == "false") {
                        $("#edit-event").attr("disabled", false);
                        $("#edit-event").html(
                            "<i class='fa fa-warning fa-spin'></i> Failed. Try Again!"
                        );
                        toastr.warning(rst.msg);
                    }
                },
                error: function(alaxB, HTTerror, errorMsg) {
                    $("#add_event").attr("disabled", false);
                    toastr.error(errorMsg);
                }
            });
        }
    }

    var DeleteEvent = function(index) {
        $("#btn_event_delete" + index).attr("disabled", true);
        $("#btn_event_delete" + index).html("<i class='fa fa-refresh fa-spin'></i> Deleting this event...");
        //deleting event
        $.ajax({
            url: $("#btn_event_delete" + index).data("href"),
            method: "GET",
            data: {},
            success: function(rst) {
                if (rst.type == "true") {
                    $("#btn_event_delete" + index).attr("disabled", false);
                    $("#btn_event_delete" + index).html("<i class='fa fa-check'></i> deleted.");
                    toastr.success(rst.msg);
                    location.reload();
                } else if (rst.type == "false") {
                    $("#btn_event_delete").attr("disabled", false);
                    $("#btn_event_delete").html(
                        "<i class='fa fa-warning'></i> Failed! Try Again."
                    );
                    toastr.warning(rst.msg);
                }
            },
            error: function(alaxB, HTTerror, errorMsg) {
                $("#add_event").attr("disabled", false);
                toastr.error(errorMsg);
            }
        });
    }

    var AddEventBanner = function() {
        var extension = $('#event_banner').val().split('.').pop().toLowerCase();
        if ($.inArray(extension, ['jpg', 'jpeg', 'png']) == -1) {
            toastr.error("This extension is not supported");
            $('#event_banner').val("");
        } else {
            $("#upload_event_image").attr("disabled", true);
            $("#upload_event_image").html("<i class='fa fa-refresh fa-spin'></i> Processing...");
            var file_data = $("#event_banner").prop("files")[0];

            var form_data = new FormData();
            form_data.append('image', file_data);
            form_data.append('_token', TOKEN);
            form_data.append('event_id', event_id);
            $.ajax({
                url: UploadEventBanner, // point to server-side PHP script
                data: form_data,
                type: "POST",
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false,
                success: function(rst) {
                    $("#upload_event_image").attr("disabled", false);
                    $("#upload_event_image").html(
                        "<i class='fa fa-check'></i> Submit!"
                    );
                    toastr.success(rst.msg);
                    location.reload();
                },
                error: function(alaxB, HTTerror, errorMsg) {
                    toastr.error(errorMsg);
                }
            });
        }
    }

    return {
        init: function() {
            loadComponents();

            $("#add_event").on("click", function() {
                AddEvent();
            });

            $("body").find("#event_details").on("click ", "#edit-event", function() {
                UpdateEvent();
            });

            $("body").find("table.table.table-striped.table-bordered.table-hover.events tbody tr")
                .each(function(index) {
                    $("#edit" + index).on("click", function() {
                        EditEvent(index);
                    });
                });

            $("body").find("table.table.table-striped.table-hover.table-bordered.events tbody tr")
                .each(function(index) {
                    $("#btn_event_delete" + index).on("click", function() {
                        $("#serverErrors").html("");
                        DeleteEvent(index);
                    });
                });
            $("#upload_event_image").on("click", function() {
                AddEventBanner();
            });

            $("#event_banner").on("change", function() {
                $("#banner").show();
            })
        }
    }
}();

$(document).ready(function() {
    AppEvents.init();
});