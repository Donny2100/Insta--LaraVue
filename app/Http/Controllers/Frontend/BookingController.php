<?php

namespace App\Http\Controllers\Frontend;


use App\Commons\Response;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Place;
use App\Notifications\CustomerContact;

;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    private $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function booking(Request $request) {
        $request['user_id'] = Auth::id();

        // echo '<pre>' . print_r($request->all(), true) . '</pre>'; die();

        if ($request->date) {
            $request['date'] = Carbon::parse($request->date);
        }

        $data = $this->validate($request, [
            'user_id' => '',
            'place_id' => '',
            'numbber_of_adult' => '',
            'numbber_of_children' => '',
            'date' => '',
            'time' => '',
            'name' => '',
            'email' => '',
            'phone_number' => '',
            'message' => '',
            'type' => ''
        ]);

        $place = Place::where('id', $request['place_id'])->with('owner')->get()[0];

        $place->owner->notify(new CustomerContact($place, $request));

        return $this->response->formatResponse(200, 'Message sent successfully');
    }
}
