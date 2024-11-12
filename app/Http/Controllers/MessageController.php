<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('message.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('message.create');
    }

    public function indexVaccineMessage()
    {
        return view('vaccine-message.index');
    }
    public function createVaccineMessage()
    {
        return view('vaccine-message.create ');
    }
    public function alert($code)
    {
        return view('vaccineAlert.index', ['code'=>$code]);
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
