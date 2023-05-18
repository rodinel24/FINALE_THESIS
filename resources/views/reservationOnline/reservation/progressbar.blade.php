<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-body">
                <ul class="progress-indicator m-4">
                    <li
                        class="{{ Route::currentRouteName() == 'reservationOnline.reservation.createIdentity' ? 'completed' : '' }} {{ Route::currentRouteName() == 'reservationOnline.reservation.pickFromCustomer' ? 'completed' : '' }} {{ Route::currentRouteName() == 'reservationOnline.reservation.viewCountPerson' ? 'completed' : '' }} {{ Route::currentRouteName() == 'reservationOnline.reservation.chooseRoom' ? 'completed' : '' }} {{ Route::currentRouteName() == 'reservationOnline.reservation.confirmation' ? 'completed' : '' }} {{ Route::currentRouteName() == 'reservationOnline.reservation.payDownPayment' ? 'completed' : '' }}">
                        <span class="bubble"></span> Personal Information
                    </li>
                    <li
                        class="{{ Route::currentRouteName() == 'reservationOnline.reservation.viewCountPerson' ? 'completed' : '' }} {{ Route::currentRouteName() == 'reservationOnline.reservation.chooseRoom' ? 'completed' : '' }} {{ Route::currentRouteName() == 'reservationOnline.reservation.confirmation' ? 'completed' : '' }} {{ Route::currentRouteName() == 'reservationOnline.reservation.payDownPayment' ? 'completed' : '' }}">
                        <span class="bubble"></span> Number of Guests
                    </li>
                    <li
                        class="{{ Route::currentRouteName() == 'reservationOnline.reservation.chooseRoom' ? 'completed' : '' }} {{ Route::currentRouteName() == 'reservationOnline.reservation.confirmation' ? 'completed' : '' }} {{ Route::currentRouteName() == 'reservationOnline.reservation.payDownPayment' ? 'completed' : '' }}">
                        <span class="bubble"></span> Room Type
                    </li>
                    <li
                        class="{{ Route::currentRouteName() == 'reservationOnline.reservation.confirmation' ? 'completed' : '' }} {{ Route::currentRouteName() == 'reservationOnline.reservation.payDownPayment' ? 'completed' : '' }}">
                        <span class="bubble"></span> Confirmation
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
