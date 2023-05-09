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

    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */


    /**
     * Display the specified resource.
     */
    public function show(request $request)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */


  

//   public function refreshcah(){
//     app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
//     return response()->json([
//         'success' => true,
//         'message' => 'cache refreshed successfully.',
//         'data' => null
//     ], 200);
//   }
}