<?php

namespace App\Http\Controllers;

use App\Models\table;
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

    public function addTabels(request $request)
    {
        // check if resturant is approved


        $resturant = resturant::where('manger_id', Auth()->user()->id )->first();
        if ($resturant->approval != "approved") {
            return response()->json([
                'success' => false,
                'message' => 'Resturant is pending or not approved.',
                'data' => null
            ], 404);
        }
        // check if table number alredy exist
        $table = table::where('table_number', $request->table_number )->first();
        if (!is_null($table)) {
            return response()->json([
                'success' => false,
                'message' => 'Table number already exist.',
                'data' => null
            ], 404);
        }

        $table = new table();
        $table->fill($request->only([
            'table_number',
            'table_capacity',
            'table_type',
            'status',



        ]));
        $table->resturant_id = $resturant->id;
        $table->save();
        return response()->json([
            'success' => true,
            'message' => 'table added successfully',
            'data' => $table
        ], 200);



    }

    public function updateTabels(request $request)
    {
        // check if resturant is approved
        $resturant = resturant::where('manger_id', Auth()->user()->id)->first();
        if ($resturant->approval != "approved") {
            return response()->json([
                'success' => false,
                'message' => 'Resturant is pending or not approved.',
                'data' => null
            ], 404);
        }
        // check if table numbe exist
        $table = table::where('table_number', $request->table_number)->first();
        if (is_null($table)) {
            return response()->json([
                'success' => false,
                'message' => 'Table number not exist.',
                'data' => null
            ], 404);
        }
        // update only the filled fields
        $table->fill($request->only([
            'table_number',
            'table_capacity',
            'table_type',
            'status',
        ]));

        $table->save();

        return response()->json([
            'success' => true,
            'message' => 'table updated successfully',
            'data' => $table
        ], 200);

    }

    public function removeTable(request $request){
        // check if resturant is approved
        //  $resturant = resturant::where('manger_id', Auth()->user()->id)->first();
        // if ($resturant->approval != "approved") {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Resturant is pending or not approved.',
        //         'data' => null
        //     ], 404);
        // }
        // check if table numbe exist
        $table = table::where('table_number', $request->table_number)->first();
        // if (is_null($table)) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Table number not exist.',
        //         'data' => null
        //     ], 404);
        // }
        $table->delete();
        return response()->json([
            'success' => true,
            'message' => 'table deleted successfully',
            'data' => $table
        ], 200);



    }



}
