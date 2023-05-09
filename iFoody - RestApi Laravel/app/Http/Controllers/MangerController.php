<?php

namespace App\Http\Controllers;

use App\Models\resturant;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

class MangerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
         $resturant = resturant::where('manger_id', Auth()->user()->id )->first();
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
    public function show(string $id)
    {
        //
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
    public function update(Request $request)
    {
        // validation info

        // update resturant info by manger id
        $resturant = resturant::where('manger_id', Auth()->user()->id )->first();
        if (is_null($resturant)) {
            return response()->json([
                'success' => false,
                'message' => 'Resturant not found.',
                'data' => null
            ], 404);
        }
        // update only the filled fields
        $resturant->fill($request->only([
            'name',
            'address',
            'phone',
            'email',
            'image',
            'image2',
            'image3',
        ]));
        $resturant->save();

        return response()->json([
            'success' => true,
            'message' => 'Resturant updated successfully',
            'data' => $resturant
        ], 200);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(request $request)
    {
        //
        
    }

}
