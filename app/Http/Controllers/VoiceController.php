<?php

namespace App\Http\Controllers;

use App\Models\Voice;
use Illuminate\Http\Request;

class VoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('voices.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($message = null  )
    {
        return view('voices.create', ['message'=>$message]);
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
    public function show(Voice $voice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Voice $voice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Voice $voice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voice $voice)
    {
        //
    }
}
