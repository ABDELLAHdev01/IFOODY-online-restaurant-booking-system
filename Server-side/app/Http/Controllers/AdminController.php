<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\resturant;
use Illuminate\Http\Request;

class AdminController extends Controller
{
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
        $resturants = resturant::where('manger_id', $request->manger_id)->first();
        if ($resturants) {
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
        // give the user the role of manger
        $user = User::find($resturant->manger_id);
        $user->assignRole('manger');

        return response()->json([
            'success' => true,
            'message' => 'Resturant approved successfully.',
            'data' => $resturant
        ], 200);
    }

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
        // soft delete
        $resturant->delete();
        return response()->json([
            'success' => true,
            'message' => 'Resturant deleted successfully.',
            'data' => $resturant
        ], 200);


  }

}