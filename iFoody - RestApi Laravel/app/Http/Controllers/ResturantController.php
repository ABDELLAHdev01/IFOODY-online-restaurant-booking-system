<?php

namespace App\Http\Controllers;

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
    public function show(resturant $resturant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(resturant $resturant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, resturant $resturant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(resturant $resturant)
    {
        //
    }
}