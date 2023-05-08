<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\resturant;
use Illuminate\Http\Request;

class ResturantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

    public function index()
    {
        //
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // store a new resturant in the database validation

        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'image' => 'required',
        ]);


        $resturant = new resturant;
        $resturant->name = $request->name;
        $resturant->address = $request->address;
        $resturant->phone = $request->phone;
        $resturant->email = $request->email;
        $resturant->image = $request->image;
        $resturant->manger_id = $request->manger_id;
        // check if manger id is valid
        $user = User::find($request->manger_id);
        if (is_null($user)) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.',
                'data' => null
            ], 404);
        }
        // check if user has a resturant
        $resturant = resturant::where('manger_id', $request->manger_id)->first();
        if ($resturant) {
            return response()->json([
                'success' => false,
                'message' => 'User already has a resturant.',
                'data' => null
            ], 404);
        }
        // if theres a second image and third image
        if($request->image2){
            $resturant->image2 = $request->image2;
        }
        if($request->image3){
            $resturant->image3 = $request->image3;
        }
        $resturant->availability = "not available";
        $resturant->approval = "approved";

        $resturant->save();

        return response()->json([
            'success' => true,
            'message' => 'Resturant created successfully',
            'data' => $resturant
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(request $request)
    {
        //
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
    public function approve(request $request)
    {
        //
        $resturant = resturant::find($request->id);
        if (is_null($resturant)) {
            return response()->json([
                'success' => false,
                'message' => 'Resturant not found.',
                'data' => null
            ], 404);
        }
        $resturant->approval = "approved";
        $resturant->save();
        return response()->json([
            'success' => true,
            'message' => 'Resturant approved successfully.',
            'data' => $resturant
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        //
        $resturant = resturant::find($id);
        if (is_null($resturant)) {
            return response()->json([
                'success' => false,
                'message' => 'Resturant not found.',
                'data' => null
            ], 404);
        }
        $resturant->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Resturant updated successfully.',
            'data' => $resturant
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(request $request)
    {
        //
        $resturant = resturant::find($request->id);
        if (is_null($resturant)) {
            return response()->json([
                'success' => false,
                'message' => 'Resturant not found.',
                'data' => null
            ], 404);
        }
        $resturant->delete();
        return response()->json([
            'success' => true,
            'message' => 'Resturant deleted successfully.',
            'data' => $resturant
        ], 200);

   }
}
