<style>
    .dropend:hover .dropdown-menu {
        display: block;
        margin-top: 0;
      
    }
    .tooltip-lg {
        font-size: 200px;
    }

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" integrity="sha512-wgmZb2EgLcsGqf3q1kYjN4dQxGjJqN3AM4ycNzFXulD/4j46kTxji/5R8WYvjMz5e+pMn1n/Hv8Ibnm7gyfZcQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="" id="sidebar-wrapper">
    <div class="d-flex flex-column"
        style="width: 4.5rem; border-top-right-radius:0.5rem; border-bottom-right-radius:0.5rem; ">
        <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
            <li class="mb-2 bg-white rounded cursor-pointer" id="dash">

                <a href="{{ route('dashboard.index') }}"
                    class="nav-link py-3 border-bottom myBtn
                    {{ in_array(Route::currentRouteName(), ['dashboard.index', 'chart.dialyGuest']) ? 'active' : '' }}
                    "
                    data-bs-toggle="tooltip" aria-expanded="false"  title="Dashboard" class="tooltip-lg">
                    <img src="icons/home.png" alt="">

                  
                    </a>
                    
                </a>
                
                
                <label for="accounts-dropdown" class="form-label">Dashboard</label>
    
            </li>
            @if (auth()->user()->role == 'Super' || auth()->user()->role == 'Admin')
                <li class="mb-2 bg-white rounded cursor-pointer">

                    <a href="{{ route('transaction.index') }}"
                        class="nav-link py-3 border-bottom border-right myBtn
                        {{ in_array(Route::currentRouteName(), [ 'transaction.index', 'transaction.reservation.createIdentity', 'transaction.reservation.pickFromCustomer', 'transaction.reservation.usersearch', 'transaction.reservation.storeCustomer', 'transaction.reservation.viewCountPerson', 'transaction.reservation.chooseRoom', 'transaction.reservation.confirmation', 'transaction.reservation.payDownPayment']) ? 'active' : '' }}
                        "
                        data-bs-toggle="tooltip" data-bs-placement="right" title="Transactions">
                        <img src="icons/transactions.png" alt="">

                    </a>
                <label for="accounts-dropdown" class="form-label">Transactions</label>

                </li>
                @endif
          
           
           
            @if (auth()->user()->role == 'Super' || auth()->user()->role == 'Admin')
               
                <li class="mb-2 bg-white rounded cursor-pointer">

                    <a class="nav-link py-3 border-bottom border-right myBtn  dropdown-toggle dropend
                    {{ in_array(Route::currentRouteName(), ['room.index', 'room.show', 'room.create', 'room.edit', 'type.index', 'type.create', 'type.edit', 'roomstatus.index', 'roomstatus.create', 'roomstatus.edit']) ? 'active' : '' }}
                        "
                        data-bs-toggle="dropdown" aria-expanded="false" title="Services">
                       <img src="icons/rooms.png" alt="">


                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('room.index') }}">Room</a></li>
                        <li><a class="dropdown-item" href="{{ route('type.index') }}">Type</a></li>
                        <li><a class="dropdown-item" href="{{ route('roomstatus.index') }}">Status</a></li>
                    </ul>
                <label for="accounts-dropdown" class="form-label">Services</label>

                </li>
                <li class="mb-2 bg-white rounded cursor-pointer">

                    <a href="#"
                        class="nav-link py-3 border-bottom border-right myBtn
                        {{ in_array(Route::currentRouteName(), [ 'report.reservationReport','reports.index' , 'payment.index'  ]) ? 'active' : '' }}
                        "
                        data-bs-toggle="dropdown" aria-expanded="true"  title="Reports">

                       
                        <img src="icons/reports.png" alt="" >

                  
                    </a>
                    <ul class="dropdown-menu" style="height: 300px; overflow-y: scroll;">
                        <!-- <li><a class="dropdown-item" href="#"><img src="icons/dailyOccupancy.png" alt=""> Daily Occupany</a></li>
                        <li><a class="dropdown-item" href="#"><img src="icons/inhouse.png" alt=""> In House Guest</a></li> -->
                        <li><a class="dropdown-item" href="{{url('/reservation/report')}}"><img src="icons/reserve.png" alt=""> Reservation Report</a></li>
                        <li><a class="dropdown-item" href="{{route('room.index')}}"><img src="icons/roomReport.png" alt=""> Room Report</a></li>
                        <li><a class="dropdown-item" href="{{ url('/report/GuestReport') }}"><img src="icons/guestlist.png" alt=""> Guest Report</a></li>
                        <!-- <li><a class="dropdown-item" href="#"><img src="icons/daily.png" alt=""> Daily Sale Report</a></li>
                        <li><a class="dropdown-item" href="#"><img src="icons/monthly.png" alt=""> Monthly Sale Report</a></li> -->
                        <li><a class="dropdown-item" href="{{url('/payment')}}"><img src="icons/payment.png" alt=""> Payment Report</a></li>
                        <li><a class="dropdown-item" href="{{url('/report/BalanceReport')}}"><img src="icons/balance.png" alt=""> Balance Report</a></li>

                    </ul>
                    </a>
                <label for="accounts-dropdown" class="form-label">Reports</label>

                </li>
                
                <li class="mb-2 bg-white rounded cursor-pointer">
                <a id="accounts-dropdown" class="nav-link py-3 border-bottom border-right myBtn dropdown-toggle {{ in_array(Route::currentRouteName(), ['customer.index', 'customer.create', 'customer.edit', 'user.index', 'user.create', 'user.edit']) ? 'active' : '' }}" data-bs-toggle="dropdown" aria-expanded="false" title="Accounts">
                    <img src="icons/users.png" alt="">
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('customer.index') }}">Customer</a></li>
                    @if (auth()->user()->role == 'Super')
                        <li><a class="dropdown-item" href="{{ route('user.index') }}">Admin</a></li>
                    @endif
                </ul>
                <label for="accounts-dropdown" class="form-label">Accounts</label>

            </li>

                
            @endif
        </ul>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js" integrity="sha512-1vcd1z5i5KZlMVHlI1Q0JlgecXGLhE7JxGn1nIS7DgWTm+Urs7hUHc6bL7V+YX9dN7yBxNpB+7VidcRzfQe/2Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
  $('a[href="#"]').click(function(event) {
    event.preventDefault();
  });
});

</script>