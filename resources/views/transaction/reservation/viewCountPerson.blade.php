@extends('template.master')
@section('title', 'Count Person')
@section('head')
    <link rel="stylesheet" href="{{ asset('style/css/progress-indication.css') }}">
@endsection
@section('content')
    @include('transaction.reservation.progressbar')
    <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <div class="card shadow-sm border rounded-3">
                <div class="card-body p-4">
                    <h2 class="card-title mb-4 text-center">Make a Reservation</h2>
                    <form class="row g-3" method="GET" action="{{ route('reservationOnline.reservation.chooseRoom', ['customer' => $customer->id]) }}">
                        <div class="col-md-12">
                            <label for="count_person" class="form-label">How many people?</label>
                            <input type="number" class="form-control rounded-3 @error('count_person') is-invalid @enderror" id="count_person" name="count_person" value="{{ old('count_person') }}" placeholder="Enter number of guests">
                            @error('count_person')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="check_in" class="form-label">Check-in Date</label>
                            <input type="date" class="form-control rounded-3 @error('check_in') is-invalid @enderror" id="check_in" name="check_in" value="{{ old('check_in') }}" placeholder="Select check-in date">
                            @error('check_in')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="check_out" class="form-label">Check-out Date</label>
                            <input type="date" class="form-control rounded-3 @error('check_out') is-invalid @enderror" id="check_out" name="check_out" value="{{ old('check_out') }}" placeholder="Select check-out date">
                            @error('check_out')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-lg btn-primary shadow-sm rounded-pill px-5 py-2">Next</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mt-4">
            <div class="card shadow-sm border rounded-3">
                <div class="card-body">
                    <div class="text-center">
                        <img src="{{ $customer->user->getAvatar() }}" class="img-fluid rounded-circle mb-3" style="width: 100px; height: 100px;">
                        <h4 class="card-title"> <i class="fas {{ $customer->gender == 'Male' ? 'fa-male' : 'fa-female' }}"></i> {{ $customer->name }} </h4>
                        <p class="card-text"><i class="fas fa-user-md"></i>{{ $customer->job }}</p>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <p class="card-text"><i class="fas fa-birthday-cake me-2"></i>{{ $customer->birthdate }}</p>
                        </div>
                        <div class="col-6">
                            <p class="card-text"><i class="fas fa-map-marker-alt me-2"></i>{{ $customer->address }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div

@endsection
