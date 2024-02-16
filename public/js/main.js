$(document, this).on('click', '.delete', function () {
    delete_id = $(this).attr('id');
    $('#confirmModal').modal('show');
});
$(document).on('click', '#ok_delete', function () {

    $.ajax({
        type: 'post',
        url: moduleName + '/delete/' + delete_id,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
            $('#ok_delete').text('Deleting...');
            $('#ok_delete').attr("disabled", true);
        },
        success: function (data) {
            console.log("data", data);
            $('#geniustable').DataTable().ajax.reload();
            $('#ok_delete').text('Delete');
            $('#ok_delete').attr("disabled", false);
            $('#confirmModal').modal('hide');
            toastr.success('Record Delete Successfully');

        }
    })
});

var activate_id;
var action = '';
var verb = '';
var color = '';
//on activate/unactivate click
$(document, this).on('click', '.activate', function () {
    activate_id = $(this).attr('id');

    //activate button text compute
    var activate_bool = $(this).data('activate');
    action = activate_bool == 1 ? 'Activate' : 'Inactivate';
    verb = activate_bool == 1 ? 'Activating' : 'Inactivating';
    color = activate_bool == 1 ? 'limegreen' : 'red';
    $('#ok_activate').text(action);
    $('#ok_activate').css('background-color', color);
    $('#ok_activate').css('border', color);

    $('#activateModal').modal('show');
});

//on activate/inactivate confirmation
$(document).on('click', '#ok_activate', function () {
    $.ajax({
        type: "post",
        url: moduleName + '/activate/' + activate_id,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
            $('#ok_activate').text(verb + '...');
            $('#ok_activate').attr("disabled", true);
        },
        success: function (data) {
            // table.ajax.reload();
            $('#geniustable').DataTable().ajax.reload();
            $('#ok_activate').text(action);
            $('#ok_activate').attr("disabled", false);
            $('#activateModal').modal('hide');
            if (!data.data) {
                toastr.error('Exception Here ! Activate');
            } else {
                toastr.success('User ' + action + 'd Successfully');
            }
        }
    })
});
