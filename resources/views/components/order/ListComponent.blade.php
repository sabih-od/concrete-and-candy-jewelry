<table id="ordertable-{{$tab}}" class="table table-bordered dt-responsive nowrap"
       style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Order Number</th>
        <th>Total Qty</th>
        <th>Total Amount</th>
        <th>Discount</th>
        <th>Amount After Discount</th>
        <th>Payment Method</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    </thead>
</table>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {

        $('#ordertable-{{$tab}}').DataTable({
            ordering: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('my.orders.index', ['page' => $pageType , 'tab' => $tab]) }}', // Use the module route
                data: function (data) {
                }
            },
            columns: [
                {data: 'order_number', name: 'order_number'},
                {data: 'total_qty', name: 'total_qty'},
                {data: 'total_price', name: 'total_price'},
                {data: 'discount', name: 'discount'},
                {data: 'total_amount_after_discount', name: 'total_amount_after_discount'},
                {data: 'payment_method', name: 'payment_method'},
                {data: 'status', name: 'status'},
                {data: 'action', searchable: false, orderable: false}
            ] // Remove the semicolon here
        });
    });
</script>
