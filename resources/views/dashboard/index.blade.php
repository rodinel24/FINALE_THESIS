@extends('template.master')
@section('title', 'Dashboard')
@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>

<span><a href="#" style="font-size: 1.2em;">Dashboard</a></span>

    <div id="dashboard">
        <div class="row">
            <div class="col-lg-6 mb-3">
                <div class="row mb-3">
                <div class="col-lg-12">
                        <div class="card shadow-sm border" style="background-image: linear-gradient(to right, #74ebd5 0%, #9face6 100%); margin-bottom:10px;">
                            <div class="card-body" >
                                <h5 style="text-align:center;"> {{ strtoupper(Helper::today()) }} </h5>
                            </div>
                        </div>
                    </div>
                  
                    <div class="col-lg-6">
                        <div class="card shadow-sm border" style="background-image: linear-gradient(to right, #74ebd5 0%, #9face6 100%); margin-bottom:10px;">
                            <div class="card-body">
                                <h5> Guests this day: {{ count($transactions) }} </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card shadow-sm border" style="background-image: linear-gradient(to right, #74ebd5 0%, #9face6 100%); margin-bottom:10px;">
                            <div class="card-body">
                            <h5>Total Revenue: &#8369;{{ number_format($revenue, 2) }}</h5>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card shadow-sm border" style="background-image: linear-gradient(to right, #74ebd5 0%, #9face6 100%); margin-bottom:10px;">
                            <div class="card-body">
                            <h5>Todays Revenue: &#8369;{{ number_format($todays_revenue, 2) }}</h5>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card shadow-sm border" style="background-image: linear-gradient(to right, #74ebd5 0%, #9face6 100%); margin-bottom:10px;">
                            <div class="card-body">
                            <h5>Monthly Revenue: &#8369;{{ $formattedRevenue }}</h5>

                            </div>
                        </div>
                    </div>
                    
                    
                 
                </div>
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="card shadow-sm border">
                            <div class="card-header">
                                <div class="row ">
                                    <div class="col-lg-12 d-flex justify-content-between">
                                        <h3>Guests Today </h3>
                                        <div>
                                      

                                                <i class="fas fa-download" id="exportBtn" style="float:right;"></i>
                                            </a>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0" >
                                <table class="table table-hover table-striped" id="dataTable">
                                    <thead>
                                    <!-- <button id="exportBtn">Export to Excel</button> -->
                                        <tr>
                                            <th></th>
                                            <th>Guest Name</th>
                                            <th>Room Number</th>
                                            <th class="text-center">Check-in/Check-out</th>
                                            <th>Day(s) Left</th>
                                            <th>Balance</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($transactions as $transaction)
                                            <tr>
                                                <td>
                                                    <img src="{{ $transaction->customer->user->getAvatar() }}"
                                                        class="rounded-circle img-thumbnail" width="40" height="40"
                                                        alt="">
                                                </td>
                                                <td>
                                                    <a
                                                        href="{{ route('customer.show', ['customer' => $transaction->customer->id]) }}">
                                                        {{ $transaction->customer->name }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('room.show', ['room' => $transaction->room->id]) }}">
                                                        {{ $transaction->room->number }}
                                                    </a>
                                                </td>
                                                <td>
                                                    {{ Helper::dateFormat($transaction->check_in) }} ~
                                                    {{ Helper::dateFormat($transaction->check_out) }}
                                                </td>
                                                <td>{{ Helper::getDateDifference(now(), $transaction->check_out) == 0 ? 'Last Day' : Helper::getDateDifference(now(), $transaction->check_out) . ' ' . Helper::plural('Day', Helper::getDateDifference(now(), $transaction->check_out)) }}
                                                </td>
                                                <td>
                                                    {{ $transaction->getTotalPrice() - $transaction->getTotalPayment() <= 0 ? '-' :($transaction->getTotalPrice() - $transaction->getTotalPayment()) }}
                                                </td>
                                                <td>
                                                    <span
                                                        class="justify-content-center badge {{ $transaction->getTotalPrice() - $transaction->getTotalPayment() == 0 ? 'bg-success' : 'bg-warning' }}">
                                                        {{ $transaction->getTotalPrice() - $transaction->getTotalPayment() == 0 ? 'Success' : 'Progress' }}
                                                    </span>
                                                    @if (Helper::getDateDifference(now(), $transaction->check_out) < 1)
                                                        <span class="justify-content-center badge bg-danger">
                                                            must finish payment
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center">
                                                    There's no data in this table
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{-- <div class="row justify-content-md-center mt-3">
                                    <div class="col-sm-10 d-flex mx-auto justify-content-md-center">
                                        <div class="pagination-block">
                                            {{ $transactions->onEachSide(1)->links('template.paginationlinks') }}
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">

                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="card shadow-sm border">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">Monthly Guests Chart</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <p class="d-flex flex-column">
                                       
                                    </p>
                                    {{-- <p class="ml-auto d-flex flex-column text-right">
                                    <span class="text-success">
                                        <i class="fas fa-arrow-up"></i> Belum
                                    </span>
                                    <span class="text-muted">Since last month</span>
                                </p> --}}
                                </div>
                                <div class="position-relative mb-4">
                                    <canvas this-year="{{ Helper::thisYear() }}" this-month="{{ Helper::thisMonth() }}"
                                        id="visitors-chart" height="400" width="100%" class="chartjs-render-monitor"
                                        style="display: block; width: 249px; height: 200px;"></canvas>
                                </div>
                                <div class="d-flex flex-row justify-content-between">
                                    <span class="mr-2">
                                        <i class="fas fa-square text-primary"></i> {{ Helper::thisMonth()  }}
                                    </span>
                                    <span>
                                        <i class="fas fa-square text-gray"></i> Last month
                                    </span>
                                </div>
                            </div>
                            <script>
        $('#exportBtn').on('click', function() {
                            // Get HTML table data
                    var table = document.getElementById("dataTable");
                    var wb = XLSX.utils.table_to_book(table);
                    // Save data to Excel file

                    XLSX.writeFile(wb, "Guests_Today.xlsx");
                        });
    </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- @section('footer')
    <script src="{{ asset('style/js/chart.min.js') }}"></script>
    <script src="{{ asset('style/js/guestsChart.js') }}"></script>

    
    <script>
          

        function reloadJs(src) {
            src = $('script[src$="' + src + '"]').attr("src");
            $('script[src$="' + src + '"]').remove();
            $('<script/>').attr('src', src).appendTo('head');
        }

        Echo.channel('dashboard')
            .listen('.dashboard.event', (e) => {
                $("#dashboard").hide()
                $("#dashboard").load(window.location.href + " #dashboard");
                $("#dashboard").show(150)
                reloadJs('style/js/guestsChart.js');
                toastr.warning(e.message, "Hello, {{ auth()->user()->name }}");
            })


                        
           
                

    </script>
@endsection --}}
