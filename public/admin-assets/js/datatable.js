$(document).ready(function () {

    $('#geniustable').DataTable({
        ordering: false,
        processing: true,
        serverSide: true,
        ajax: {
            url: indexRoute, // Use the module route
            data: function (data) {
                // You can add any additional data you want to send to the server here.
            }
        },
        columns: columnsConfig
    });

});
