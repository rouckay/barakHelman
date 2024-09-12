<?php

namespace App\Http\Controllers;

use App\Models\CustomerNumeraha;
use App\Models\numeraha;
use Illuminate\Http\Request;

class numerahaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Numeraha = numeraha::with('Customers')->get();
        // dd($Numeraha);
        return view('home', ['Numeraha' => $Numeraha]);
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
    public function show(numeraha $numeraha)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(numeraha $numeraha)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, numeraha $numeraha)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(numeraha $numeraha)
    {
        //
    }
}
