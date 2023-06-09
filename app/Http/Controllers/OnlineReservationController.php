<?php

namespace App\Http\Controllers;

use App\Events\NewReservationEvent;
use App\Events\RefreshDashboardEvent;
use App\Helpers\Helper;
use App\Http\Requests\ChooseRoomRequest;
use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use App\Models\Room;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\NewRoomReservationDownPayment;
use App\Repositories\CustomerRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\ReservationRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;

class OnlineReservationController extends Controller
{
    private $reservationRepository;

    public function __construct(ReservationRepository $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }

    public function pickFromCustomer(Request $request, CustomerRepository $customerRepository)
    {
        $customers = $customerRepository->get($request);
        $customersCount = $customerRepository->count($request);
        return view('reservationOnline.reservation.pickFromCustomer', compact('customers', 'customersCount'));
    }

    public function createIdentity()
    {
        return view('reservationOnline.reservation.createIdentity');
    }

    public function storeCustomer(StoreCustomerRequest $request, CustomerRepository $customerRepository)
    {
        $customer = $customerRepository->store($request);
        return redirect()->route('reservationOnline.reservation.viewCountPerson', ['customer' => $customer->id])->with('success', 'Customer ' . $customer->name . ' created!');
    }

    public function viewCountPerson(Customer $customer)
    {
        return view('reservationOnline.reservation.viewCountPerson', compact('customer'));
    }

    public function chooseRoom(ChooseRoomRequest $request, Customer $customer)
    {
        $stayFrom = $request->check_in;
        $stayUntil = $request->check_out;

        $occupiedRoomId = $this->getOccupiedRoomID($request->check_in, $request->check_out);

        $rooms = $this->reservationRepository->getUnocuppiedroom($request, $occupiedRoomId);
        $roomsCount = $this->reservationRepository->countUnocuppiedroom($request, $occupiedRoomId);

        return view('reservationOnline.reservation.chooseRoom', compact('customer', 'rooms', 'stayFrom', 'stayUntil', 'roomsCount'));
    }

    public function confirmation(Customer $customer, Room $room, $stayFrom, $stayUntil)
    {
        $price = $room->price;
        $dayDifference = Helper::getDateDifference($stayFrom, $stayUntil);
        $downPayment = ($price * $dayDifference) * 0.50;
        return view('reservationOnline.reservation.confirm', compact('customer', 'room', 'stayFrom', 'stayUntil', 'downPayment', 'dayDifference'));
    }

    public function confirmReservation(Request $request)
    {
        // Perform any necessary validation or processing of the reservation data here

        // Send confirmation email to the provided email address
        $email = $request->input('email');
        // Code to send the confirmation email goes here

        // Return a response to the user
        return view('confirmation')->with('email', $email);
    }

  

    public function payDownPayment(Customer $customer, Room $room, Request $request, TransactionRepository $transactionRepository, PaymentRepository $paymentRepository)
    {
        $dayDifference = Helper::getDateDifference($request->check_in, $request->check_out);
        $minimumDownPayment = ($room->price * $dayDifference) * 0.50;

        $request->validate([
            'downPayment' => 'required|numeric|gte:' . $minimumDownPayment
        ]);

        $occupiedRoomId = $this->getOccupiedRoomID($request->check_in, $request->check_out);
        $occupiedRoomIdInArray = $occupiedRoomId->toArray();

        if (in_array($room->id, $occupiedRoomIdInArray)) {
            return redirect()->back()->with('failed', 'Sorry, room ' . $room->number . ' already occupied');
        }

        $transaction = $transactionRepository->store($request, $customer, $room);
        $status = 'Down Payment';
        $payment = $paymentRepository->store($request, $transaction, $status);

        $superAdmins = User::where('role', 'Super')->get();

        foreach ($superAdmins as $superAdmin) {
            $message = 'Reservation added by ' . $customer->name;
            event(new NewReservationEvent($message, $superAdmin));
            $superAdmin->notify(new NewRoomReservationDownPayment($transaction, $payment));
        }

        event(new RefreshDashboardEvent("Someone reserved a room"));

        return view('reservationOnline.reservation.prompt')->with('success', 'Room ' . $room->number . ' has reserved by ' . $customer->name);
    }
    public function prompt()
    {
        return view('reservationOnline.reservation.prompt');
    }

    private function getOccupiedRoomID($stayFrom, $stayUntil)
    {
        $occupiedRoomId = Transaction::where([['check_in', '<=', $stayFrom], ['check_out', '>=', $stayUntil]])
            ->orWhere([['check_in', '>=', $stayFrom], ['check_in', '<=', $stayUntil]])
            ->orWhere([['check_out', '>=', $stayFrom], ['check_out', '<=', $stayUntil]])
            ->pluck('room_id');
        return $occupiedRoomId;
    }
}
