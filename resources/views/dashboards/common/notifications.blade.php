@extends('dashboards.user.index')

@section('content')



    <div class="col-lg-9 layout">
        <div class="recentOrders">
            <h4>Notifications</h4>
        </div>
        <div class="recentTable tablecard">
            <div class="table-responsive-lg">

                <table class="table table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Notification</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($notifications as $notification)
                        <tr>
                            <td>
                                {{ $notification->content_body }}
                                <a href="{{ route('notification.delete' , ['notification' => $notification->id]) }}"><i
                                        class="fas fa-trash text-danger float-right"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>
                                No notifications yet!!!
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>


                <div class="col-md-12">
                    <nav class="pagination">
                        {{ $notifications->links('alerts.custom-pagination') }}
                    </nav>
                </div>


            </div>
        </div>
    </div>

    </div>
    </div>
    </section>

@endsection
