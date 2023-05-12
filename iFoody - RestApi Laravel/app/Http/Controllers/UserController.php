<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\table;
use App\Models\resturant;
use App\Models\reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $resturants = resturant::all();
        if($resturants->isEmpty()){
            return response()->json([
                'success' => false,
                'message' => 'Resturants not found.',
                'data' => null
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Resturants retrieved successfully',
            'data' => $resturants
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(request $request)
    {
        $resturant = resturant::find($request->id);
        if (is_null($resturant)) {
            return response()->json([
                'success' => false,
                'message' => 'Resturant not found.',
                'data' => null
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Resturant retrieved successfully.',
            'data' => $resturant
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

     public function applyresturant(request $request)
    {
        // validation
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'image' => 'required',
        ]);
        // check if auth user had alredy a resturant and type approved
        $resturant = resturant::where('manger_id', auth()->user()->id)->first();
        if ($resturant) {
                return response()->json([
                    'success' => false,
                    'message' => 'User already has a resturant.',
                    'data' => null
                ], 404);


        }
        //  chack if the table is booking for the next 2 hours using carbon







        // add resturant

        $resturant = new resturant;
        $resturant->name = $request->name;
        $resturant->address = $request->address;
        $resturant->phone = $request->phone;
        $resturant->email = $request->email;
        $resturant->image = $request->image;
        $resturant->manger_id = auth()->user()->id;
        // if theres a second image and third image
        if($request->image2){
            $resturant->image2 = $request->image2;
        }
        if($request->image3){
            $resturant->image3 = $request->image3;
        }
        $resturant->availability = "not available";
        $resturant->approval = "pending";

        $resturant->save();
        return response()->json([
            'success' => true,
            'message' => 'Resturant created successfully',
            'data' => $resturant
        ], 201);


    }

    public function bookTable(request $request)
    {
        // validation
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'date' => 'required',
            'time' => 'required',
            'number_of_people' => 'required',
            'resturant_id' => 'required',
        ]);
       if($request->date < Carbon::now()->format('Y-m-d')){
            return response()->json([
                'success' => false,
                'message' => 'You cant book a table in the past.',
                'data' => null
            ], 404);
        }
        if($request->date > Carbon::now()->addDays(30)->format('Y-m-d')){
            return response()->json([
                'success' => false,
                'message' => 'You cant book a table more than 30 days from now.',
                'data' => null
            ], 404);
        }
        if($request->date >= Carbon::now()->format('Y-m-d') && $request->time < Carbon::now()->format('H:i:s')){
            return response()->json([
                'success' => false,
                'message' => 'You cant book a table in the past date.',
                'data' => null
            ], 404);
        }

        //
        // check if auth user had alredy a resturant and type approved
        $reservationalredy = reservation::where('resturant_id', $request->resturant_id)->where('date', $request->date)->where('time', $request->time)->first();
        if ($reservationalredy) {
                return response()->json([
                    'success' => false,
                    'message' => 'This table is already booked.',
                    'data' => null
                ], 404);}

        // check if the table is booking for the next 2 hours using carbon


        //    take time and add duration to it






        // reserve
        $reservation = new reservation;
        $reservation->name = $request->name;
        $reservation->phone = $request->phone;
        $reservation->date = $request->date;
        $reservation->time = $request->time;
        $reservation->duration = $request->duration;
        $reservation->number_of_people = $request->number_of_people;
        $reservation->resturant_id = $request->resturant_id;
        $reservation->user_id = auth()->user()->id;
        $reservation->table_id = $request->table_id;
        $reservation->status = "pending";
        $reservation->save();
        return response()->json([
            'success' => true,
            'message' => 'Reservation created successfully',
            'data' => $reservation
        ], 201);

    }




    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}