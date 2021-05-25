<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Table;
use App\Models\TimeSlot;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ViewReservationController extends Controller
{
    public function tableReservation($id)
    {
        $tables = Table::find($id);
        $time_slot = TimeSlot::all();
        //    dd($time_slot);

        // dd($tables);
        return view('frontend.content.reservation', compact('tables', 'time_slot'));
    }

    public function reservation(Request $request, $id)
    {
        // dd($request->all());
        // $tables = Table::find($request->tables_id);





        // $reservation_date =Carbon::parse($request->input('reservation_date'))->format('Y-m-d');
        // dd($request->all());
        $reservationCheck = Reservation::all();
        foreach ($reservationCheck as $data) {
            $tables = $data->tables_id;
            $time_slot_id_z = $data->time_slots_id;
            $reservation_date = $data->reservation_date;
            $status  = $data->status;
            $user_id = $data->user_id;
            // dd($data);

            if ($tables == $request->tables_id && $time_slot_id_z == $request->time_id &&  $reservation_date == $request->date &&  $user_id == auth()->user()->id) {
                return redirect()->back()->with('status', 'Your already request it');
            }
            if ($tables == $request->tables_id && $time_slot_id_z == $request->time_id &&  $reservation_date == $request->date ) {
                return redirect()->back()->with('status', 'This time is already taken by another and its ' . $status);
            }
        }



        // @dd('stop');


        Reservation::create([

            'tables_id' => $request->tables_id,
            'time_slots_id' => $request->time_id,
            'user_id' => auth()->user()->id,
            'reservation_date' => $request->date,
            'message' => $request->message,
        ]);
        // dd($tables);


        return redirect()->back()->with('message', 'Reservation request create Successfully');
    }
}
