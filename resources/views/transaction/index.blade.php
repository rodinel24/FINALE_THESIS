@extends('template.master')
@section('title', 'Reservation')
@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>

<span><a href="#" style="font-size: 1.2em;">Transaction</a></span>

    <div class="row mt-2 mb-2">
        <div class="col-lg-6 mb-2">
            <div class="d-grid gap-2 d-md-block">
                <span data-bs-toggle="tooltip" data-bs-placement="right" title="Add Room Reservation">
                    <button type="button" class="btn btn-sm shadow-sm myBtn border rounded" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">
                        <i class="fas fa-plus"></i>
                    </button>
                </span>
                <span data-bs-toggle="tooltip" data-bs-placement="right" title="Payment History">
                    <a href="{{route('payment.index')}}" class="btn btn-sm shadow-sm myBtn border rounded">
                        <i class="fas fa-history"></i>
                    </a>
                </span>
            </div>
        </div>
        <div class="col-lg-6 mb-2">
            <form class="d-flex" method="GET" action="{{ route('transaction.index') }}">
                <input class="form-control me-2" type="search" placeholder="Search by ID" aria-label="Search"
                    id="search-user" name="search" value="{{ request()->input('search') }}">
                <button class="btn btn-outline-dark" type="submit">Search</button>
                                </form>
                            </div>
                        </div>
                        <div class="row my-2 mt-4 ms-1">
                            <div class="col-lg-12">
                                <h5>Reservations: </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                        <table class="table table-sm table-hover" id="myTable">
    <i class="fas fa-download" id="exportBtn" style="float:right;"></i>

    <thead>
        <tr>
            <th>#</th>
            <th>ID</th>
            <th>Guest Name</th>
            <th>Email</th>
            <th>Room Number</th>
            <th>Room Type</th>
            <th>Check In</th>
            <th>Check Out</th>
            <th>Days</th>
            <th>Total Price</th>
            <th>Paid</th>
            <th>Balance</th>
            <th>Payment</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($transactions as $transaction)
        <tr>
            <th>{{ ($transactions->currentpage() - 1) * $transactions->perpage() + $loop->index + 1 }}</th>
            <td>{{ $transaction->id }}</td>
            <td>{{ $transaction->customer->name }}</td>
            <td>{{ $transaction->customer->user->email }}</td>
            <td>{{ $transaction->room->number }}</td>
            <td>{{ $transaction->room->type->name }}</td>
            <td>{{ Helper::dateFormat($transaction->check_in) }}</td>
            <td>{{ Helper::dateFormat($transaction->check_out) }}</td>
            <td>{{ $transaction->getDateDifferenceWithPlural($transaction->check_in, $transaction->check_out) }}</td>
            <td>{{ $transaction->getTotalPrice() }}</td>
            <td>{{ $transaction->getTotalPayment() }}</td>
            <td>{{ $transaction->getTotalPrice() - $transaction->getTotalPayment() <= 0 ? '-' : ($transaction->getTotalPrice() - $transaction->getTotalPayment()) }}</td>
            <td>
                <a class="btn btn-light btn-sm rounded shadow-sm border p-1 m-0 {{$transaction->getTotalPrice() - $transaction->getTotalPayment() <= 0 ? 'disabled' : ''}}"
                    href="{{ route('transaction.payment.create', ['transaction' => $transaction->id]) }}"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Pay">
                    <i class="fas fa-money-bill-wave-alt"></i>
                </a>
            </td>
            <td>
                            <button class="btn btn-light btn-sm rounded shadow-sm border p-1 m-0 check-in-btn" data-bs-toggle="tooltip"
                    data-bs-placement="top" title="Check-in" data-transaction-id="{{ $transaction->id }}">
                    <i class="fas fa-check"></i>
                </button>

                <button class="btn btn-light btn-sm rounded shadow-sm border p-1 m-0 cancel-btn"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel"
                    data-transaction-id="{{ $transaction->id }}"
                    onclick="event.preventDefault(); if(confirm('Are you sure you want to cancel this transaction?')) { document.getElementById('cancel-form-{{ $transaction->id }}').submit(); }">
                    <i class="fas fa-times-circle"></i>
                </button>
                <form id="cancel-form-{{ $transaction->id }}" action="{{ route('transaction.destroy', ['transaction' => $transaction->id]) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>

            </td>
        </tr>
        @empty
        <tr>
            <td colspan="14" class="text-center">
                There's no data in this table
            </td>
        </tr>
        @endforelse
    </tbody>
</table>


           

</div></div>
</div>
                    <!-- Another data table -->
                    <div class="row my-2 mt-4 ms-1">
    <div class="col-lg-12">
        <h5>Transferred Reservations: </h5>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover" id="transferredTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Guest Name</th>
                                <th>Email</th>
                                <th>Room Number</th>
                                <th>Room Type</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Days</th>
                                <th>Total Price</th>
                                <th>Paid</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Populate the transferred reservations here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

 <div class="row my-2 mt-4 ms-1" >
        <div class="col-lg-12">
            <h5>Check-out Guests: </h5>
        </div>
    </div>
    <div class="row" >
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body" id="checkout">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Room</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th>Days</th>
                                    <th>Total Price</th>
                                    <th>Paid Off</th>
                                    <th>Debt</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactionsExpired as $transaction)
                                <tr>
                                    <th>{{ ($transactions->currentpage() - 1) * $transactions->perpage() + $loop->index + 1 }}
                                    </th>
                                    <td>{{ $transaction->id }}</td>
                                    <td>{{ $transaction->customer->name }}</td>
                                    <td>{{ $transaction->room->number }}</td>
                                    <td>{{ Helper::dateFormat($transaction->check_in) }}</td>
                                    <td>{{ Helper::dateFormat($transaction->check_out) }}</td>
                                    <td>{{ $transaction->getDateDifferenceWithPlural($transaction->check_in, $transaction->check_out) }}
                                    </td>
                                    <td>{{ ($transaction->getTotalPrice()) }}
                                    </td>
                                    <td>
                                        {{ ($transaction->getTotalPayment()) }}
                                    </td>
                                    <td>{{ $transaction->getTotalPrice() - $transaction->getTotalPayment() <= 0 ? '-' : ($transaction->getTotalPrice($transaction->room->price, $transaction->check_in, $transaction->check_out) - $transaction->getTotalPayment()) }}
                                    </td>
                                    <td>
                                        <a class="btn btn-light btn-sm rounded shadow-sm border p-1 m-0 {{$transaction->getTotalPrice($transaction->room->price, $transaction->check_in, $transaction->check_out) - $transaction->getTotalPayment() <= 0 ? 'disabled' : ''}}"
                                            href="{{ route('transaction.payment.create', ['transaction' => $transaction->id]) }}"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Pay">
                                            <i class="fas fa-money-bill-wave-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="15" class="text-center">
                                        There's no data in this table
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{ $transactions->onEachSide(2)->links('template.paginationlinks') }}
                    </div>
                </div> 
            </div>
        </div>
    </div>

                    <script>
    $(document).ready(function() {
        $(document).on('click', '.check-in-btn', function() {
            var transactionId = $(this).data('transaction-id');
            var $row = $(this).closest('tr');
            var guestName = $row.find('td:nth-child(3)').text();

        
            
            if (confirmation) {
                // Add the checked-in data to the new table
                var $checkedInTableBody = $('#checkedInTable tbody');
                $checkedInTableBody.append('<tr><td>' + transactionId + '</td><td>' + guestName + '</td></tr>');

                // Remove the row from the current table
                $row.remove();

                // Refresh the Bootstrap tooltip after modifying the DOM
                $('[data-bs-toggle="tooltip"]').tooltip('dispose');
                $('[data-bs-toggle="tooltip"]').tooltip();
            }
        });
    });

    $(document).ready(function () {
        $('.cancel-btn').click(function () {
            var transactionId = $(this).data('transaction-id');

            if (confirm('Are you sure you want to cancel this transaction?')) {
                $.ajax({
                    url: '/transactions/' + transactionId,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        // Reload the table or update the view accordingly
                        location.reload();
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
</script>
                    
    <!-- <div class="row my-2 mt-4 ms-1" >
        <div class="col-lg-12">
            <h5>Check-out Guests: </h5>
        </div>
    </div>
    <div class="row" >
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body" id="checkout">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Room</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th>Days</th>
                                    <th>Total Price</th>
                                    <th>Paid Off</th>
                                    <th>Debt</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactionsExpired as $transaction)
                                <tr>
                                    <th>{{ ($transactions->currentpage() - 1) * $transactions->perpage() + $loop->index + 1 }}
                                    </th>
                                    <td>{{ $transaction->id }}</td>
                                    <td>{{ $transaction->customer->name }}</td>
                                    <td>{{ $transaction->room->number }}</td>
                                    <td>{{ Helper::dateFormat($transaction->check_in) }}</td>
                                    <td>{{ Helper::dateFormat($transaction->check_out) }}</td>
                                    <td>{{ $transaction->getDateDifferenceWithPlural($transaction->check_in, $transaction->check_out) }}
                                    </td>
                                    <td>{{ ($transaction->getTotalPrice()) }}
                                    </td>
                                    <td>
                                        {{ ($transaction->getTotalPayment()) }}
                                    </td>
                                    <td>{{ $transaction->getTotalPrice() - $transaction->getTotalPayment() <= 0 ? '-' : ($transaction->getTotalPrice($transaction->room->price, $transaction->check_in, $transaction->check_out) - $transaction->getTotalPayment()) }}
                                    </td>
                                    <td>
                                        <a class="btn btn-light btn-sm rounded shadow-sm border p-1 m-0 {{$transaction->getTotalPrice($transaction->room->price, $transaction->check_in, $transaction->check_out) - $transaction->getTotalPayment() <= 0 ? 'disabled' : ''}}"
                                            href="{{ route('transaction.payment.create', ['transaction' => $transaction->id]) }}"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Pay">
                                            <i class="fas fa-money-bill-wave-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="15" class="text-center">
                                        There's no data in this table
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{ $transactions->onEachSide(2)->links('template.paginationlinks') }}
                    </div>
                </div> 
            </div>
        </div>
    </div>-->


   


   <script>
   



$('#exportBtn').on('click', function() {
                 // Get HTML table data
        var table = document.getElementById("myTable");
        var wb = XLSX.utils.table_to_book(table);

        // Save data to Excel file
        XLSX.writeFile(wb, "Transaction_table.xlsx");
            });

   </script>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <a class="btn btn-sm btn-primary m-1"
                            href="{{ route('transaction.reservation.createIdentity') }}">Create
                            new account!</a>
                        <a class="btn btn-sm btn-success m-1"
                            href="{{ route('transaction.reservation.pickFromCustomer') }}">Use
                            current account!</a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
