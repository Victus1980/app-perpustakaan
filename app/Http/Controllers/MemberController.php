<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return 'MemberControler@index';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return 'MemberControler@create';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return 'MemberControler@store';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "MemberControler@show, id: {$id}";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return "MemberControler@edit, id: {$id}";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return "MemberControler@update, id: {$id}";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return "MemberControler@destroy, id: {$id}";
    }
}
