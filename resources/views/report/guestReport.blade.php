@extends('template.master')
@section('title', 'Reservation')
@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>

<span><a href="#" style="font-size: 1.2em;">customer</a></span>

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
            <form class="d-flex" method="GET" action="{{ route('customer.index') }}">
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
                                    <th>Gender</th>
                                    <th>Job</th>
                                    <th>Address</th>
                                    <th>Check-in Date</th>
                                    <th>Check-out Date</th>
                                    
                                    
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
                                        <td>{{ $transaction->customer->gender }}</td>
                                        <td>{{ $transaction->customer->job }}</td>
                                        <td>{{ $transaction->customer->address }}</td>

                                        
                                       
                                        <td>{{ Helper::dateFormat( $transaction->check_in) }}</td>
                                        <td>{{  Helper::dateFormat($transaction->check_out) }}</td>
                                        
                                      
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
        XLSX.writeFile(wb, "Guest_table.xlsx");
            });

   </script>

   
@endsection
