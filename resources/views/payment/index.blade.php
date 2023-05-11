@extends('template.master')
@section('title', 'Payment')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<span><a href="#" style="font-size: 1.2em;">Reports/<span><a href="#" style="font-size: 1.2em;">Payment Report </a></span> </a></span>

    <div class="card shadow-sm border">

        <div class="card-body">

            <table class="table table-hover" id="myTable">
                <i class="fas fa-download" id="exportBtn" style="float:right;"></i>

                <thead>

                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Room</th>
                        <th scope="col">Paid Off</th>
                        <th scope="col">Status</th>
                        <th scope="col">At</th>
                        <th scope="col">Served By</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($payments as $payment)
                        <tr>
                            <th scope="row">{{ ($payments->currentpage() - 1) * $payments->perpage() + $loop->index + 1 }}
                            </th>
                            <td>{{ $payment->transaction->room->number }}</td>
                            <td>{{($payment->price)}}</td>
                            <td>{{ $payment->status }}</td>
                            <td>{{ Helper::dateFormatTime($payment->created_at) }}</td>
                            <td>{{ $payment->user->name }}</td>
                            <td> <a href="{{ route('payment.invoice', $payment->id) }}">E-Receipt</a> </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="10">Theres no payment found on database</td>
                        </tr>
                    @endforelse
                </tbody>
                <script>
    
$('#exportBtn').on('click', function() {
                 // Get HTML table data
        var table = document.getElementById("myTable");
        var wb = XLSX.utils.table_to_book(table);

        // Save data to Excel file
        XLSX.writeFile(wb, "Payment_table.xlsx");
            });


</script>
            </table>
            {{ $payments->onEachSide(2)->links('template.paginationlinks') }}
        </div>
    </div>

@endsection
