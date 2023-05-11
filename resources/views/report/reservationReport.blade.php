@extends('template.master')
@section('title', 'Reservation Report')
@section('content')
    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
<span><a href="#" style="font-size: 1.2em;">Reports/<span><a href="#" style="font-size: 1.2em;">Reservation Report </a></span> </a></span>

    <div class="row mt-2 mb-2">
        <div class="col-lg-6 mb-2">
           
        </div>
        <div class="col-lg-6 mb-2">
            <form class="d-flex" method="GET" action="{{ route('reservationReport') }}">
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
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $transaction)
                                    <tr>
                                        <th>{{ ($transactions->currentpage() - 1) * $transactions->perpage() + $loop->index + 1 }}
                                        </th>
                                        <td>{{ $transaction->id }}</td>
                                        <td>{{ $transaction->customer->name }}</td>
                                        <td>{{ $transaction->customer->user->email }}</td>
                                        <td>{{ $transaction->room->number }}</td>
                                        <td>{{ $transaction->room->type->name }}</td>
                                        <td>{{ Helper::dateFormat($transaction->check_in) }}</td>
                                        <td>{{ Helper::dateFormat($transaction->check_out) }}</td>
                                        <td>{{ $transaction->getDateDifferenceWithPlural($transaction->check_in, $transaction->check_out) }}
                                        </td>
                                        <td>{{ ($transaction->getTotalPrice()) }}
                                        </td>
                                        <td>
                                            {{ ($transaction->getTotalPayment()) }}
                                        </td>
                                        <td>{{ $transaction->getTotalPrice() - $transaction->getTotalPayment() <= 0 ? '-' : ($transaction->getTotalPrice() - $transaction->getTotalPayment()) }}
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
   



$('#exportBtn').on('click', function() {
                 // Get HTML table data
        var table = document.getElementById("myTable");
        var wb = XLSX.utils.table_to_book(table);

        // Save data to Excel file
        XLSX.writeFile(wb, "Reservation_Report.xlsx");
            });

   </script>

   
@endsection
