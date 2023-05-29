
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hotel Booking Process</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.9/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/themes/material_blue.css">
    <link rel="stylesheet" href="booking.css">

    <style>



</style>
</head>
<body style="background-color: #0F1521;">

<header class="flex items-center justify-between py-4 px-6 bg-#0F1521  mb-3 "  style="border-bottom:10px;">

        <div class="flex items-center">
            <a href="{{url('/')}}">
                <img class="h-20" src="../img/msat.png" alt="Hotel Logo">
            </a>
            <h1 class="ml-4 text-2xl font-bold text-white">Dr. Magadapa Ali Ringia Hotel</h1>
            <div class="text-left" style="margin-left:0.8cm; line-height:1;">
  <p class="text-white font-medium">MSU-MSAT, Maigo, Lanao del Norte, Philippines, 9206</span>
    <br>Telephone Number:  <span class="text-blue-500 italic"> 227-4208<br></span>
 <span class="text-black-700 font-medium"> Email: <span class="text-blue-500 italic">Dr.magadapaaliringia@gmail.com</span></p>
</div>
        <div class="flex items-center" style="margin-left:10cm;">
            <ul class="text-gray-600">
            <li class="text-blue-500 text- text-lg italic underline font-bold">Choose Room</li>

            </ul>
        </div>
        </div>
    </header>
<div class="bg-white mb-3" style="border-radius:20px; position:sticky;"><br></div>

    </body>

    <script src="booking.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>


</html>

@section('title', 'Choose Room Reservation')
@section('head')
    <link rel="stylesheet" href="{{ asset('style/css/progress-indication.css') }}">
    <style>
        .wrapper {
            max-width: 400px;
        }

        .demo-1 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }

    </style>
@endsection

@vite('resources/sass/app.scss')

    @include('reservationOnline.reservation.progressbar')
      
    <div class="container mt-3">
        <div class="row justify-content-md-center">
            <div class="col-md-8 mt-2">
                <div class="card shadow-sm border">
                    <div class="card-body p-3">
                        <h2>Available Rooms: {{ $roomsCount }} </h2>
                        <p>{{ request()->input('count_person') }}
                            {{ Helper::plural('Person(s)', request()->input('count_person')) }} on
                            {{ Helper::dateFormat(request()->input('check_in')) }} to
                            {{ Helper::dateFormat(request()->input('check_out')) }}</p>
                        <hr>
                        <form method="GET"
                            action="{{ route('reservationOnline.reservation.chooseRoom', ['customer' => $customer->id]) }}">
                            <div class="row mb-2">
                                <input type="text" hidden name="count_person"
                                    value="{{ request()->input('count_person') }}">
                                <input type="date" hidden name="check_in" value="{{ request()->input('check_in') }}">
                                <input type="date" hidden name="check_out" value="{{ request()->input('check_out') }}">
                                <div class="col-lg-8">
                                    <select class="form-select" id="sort_name" name="sort_name"
                                        aria-label="Default select example">
                                        <option value="Price" @if (request()->input('sort_name') == 'Price') selected @endif>Price</option>
                                        <option value="Capacity" @if (request()->input('sort_name') == 'Capacity') selected @endif>Capacity</option>
                                    </select>
                                </div>
                                <!-- <div class="col-lg-4">
                                    <select class="form-select" id="sort_type" name="sort_type"
                                        aria-label="Default select example">
                                        <option value="ASC" @if (request()->input('sort_type') == 'ASC') selected @endif>Ascending</option>
                                        <option value="DESC" @if (request()->input('sort_type') == 'DESC') selected @endif>Descending</option>
                                    </select>
                                </div> -->
                                <div class="col-lg-4 ml-auto ">
                                    <button type="submit" class="btn myBtn shadow-sm border w-100">Search</button>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            @forelse ($rooms as $room)
                                <div class="col-lg-12">
                                    <div
                                        class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                                        <div class="col p-4 d-flex flex-column position-static">
                                            <strong class="d-inline-block mb-2 text-secondary">Room Capacity: {{ $room->capacity }}
                                                {{ Str::plural('Person', $room->capacity) }}</strong>
                                            <h3 class="mb-0">{{ $room->number }}  {{ $room->type->name }}</h3>
                                            <div class="mb-1 text-muted">Price: {{($room->price) }} /
                                                Day
                                            </div>
                                            <div class="wrapper">
                                                <p class="card-text mb-auto demo-1">{{ $room->view }}</p>
                                            </div>
                                            <a href="{{ route('reservationOnline.reservation.confirmation', ['customer' => $customer->id, 'room' => $room->id, 'from' => request()->input('check_in'), 'to' => request()->input('check_out')]) }}"
                                                class="btn myBtn shadow-sm border w-100 m-2">Choose</a>
                                        </div>
                                        <div class="col-auto d-none d-lg-block">
                                            <img src="{{ $room->firstImage() }}" width="200" height="250" alt="">
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h3>Theres no available room for {{ request()->input('count_person') }} or more
                                    person
                                </h3>
                            @endforelse
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                {{ $rooms->onEachSide(1)->appends([
                                    'count_person' => request()->input('count_person'),
                                    'check_in' => request()->input('check_in'),
                                    'check_out' => request()->input('check_out'),
                                    'sort_name' => request()->input('sort_name'),
                                    'sort_type' => request()->input('sort_type'),
                                ])->links('template.paginationlinks') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mt-4">
            <div class="card shadow-sm border rounded-3">
                <div class="card-body">
                    <div class="text-center">
                    <div class="d-flex justify-content-center align-items-center">
                        <img src="{{ $customer->user->getAvatar() }}" class="img-fluid rounded-circle mb-3" style="width: 100px; height: 100px;">
                    </div>

                        
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <p class="card-text"><strong>Name:</strong>{{ Str::ucfirst($customer->name) }}</p>
                        </div>
                        <div class="col-6">
                            <p class="card-text"><strong>Gender:</strong>{{ Str::ucfirst($customer->gender == 'Male' ? 'Male' : 'female') }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p class="card-text"><strong>Birthdate:</strong>{{ Str::ucfirst($customer->birthdate)  }}</p>
                        </div>
                        <div class="col-6">
                            <p class="card-text"><strong>Address:</strong>{{ Str::ucfirst( $customer->address )}}</p>
                        </div>
                    </div>

                        </div>
                    </div>
                </div>
            </div>
