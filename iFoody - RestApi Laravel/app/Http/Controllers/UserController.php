<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\resturant;

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
