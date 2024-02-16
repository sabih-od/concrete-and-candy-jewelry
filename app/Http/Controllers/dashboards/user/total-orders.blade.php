@extends('dashboards.user.index')

@section('content')


    <div class="col-lg-9 layout">
        <div class="profileSetting totalOrder">
            <div class="totalPayment totalOrder-heading">
                <h3 class="heading">Total Orders</h3>
            </div>
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-all" role="tab"
                       aria-controls="pills-home" aria-selected="true">All Orders!</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-pending" role="tab"
                       aria-controls="pills-profile" aria-selected="false">Orders Pending!</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-completed" role="tab"
                       aria-controls="pills-contact" aria-selected="false">Orders Completed!</a>
                </li>
            </ul>

            <div class="tab-content" id="pills-tabContent">

                <div class="tab-pane fade show active" id="pills-all" role="tabpanel"
                     aria-labelledby="pills-all-tab">
                    <div class="recentTable totalPayment-table tablecard">
                        <div class="table-responsive-lg">
                            <x-order.ListComponent :pageType="'my_orders'" :tab="'all_orders'"/>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade show" id="pills-pending" role="tabpanel"
                     aria-labelledby="pills-pending-tab">
                    <div class="recentTable totalPayment-table tablecard">
                        <div class="table-responsive-lg">
                            <x-order.ListComponent :pageType="'my_orders'" :tab="'pending_orders'"/>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade show" id="pills-completed" role="tabpanel"
                     aria-labelledby="pills-completed-tab">
                    <div class="recentTable totalPayment-table tablecard">
                        <div class="table-responsive">
                            <x-order.ListComponent :pageType="'my_orders'" :tab="'completed_orders'"/>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- section css end -->
    </div>
    </div>
    </section>


@endsection

@section('script')

    <script>
        $(document).ready(function () {
            // Get the last active tab from local storage
            var lastActiveTab = localStorage.getItem('lastActiveTab');

            // If there's a last active tab, set it as the active tab
            if (lastActiveTab) {
                $('#pills-tab a[href="' + lastActiveTab + '"]').tab('show');
            }

            // When a tab is shown, update the last active tab in local storage
            $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
                var targetTab = $(e.target).attr('href');
                localStorage.setItem('lastActiveTab', targetTab);
            });
        });
    </script>


@endsection
