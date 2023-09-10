<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Elearning;
use Illuminate\Http\Request;

class ElearningController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:view_elearning'])->only('index');
        $this->middleware(['permission:add_elearning'])->only('store');
        $this->middleware(['permission:edit_elearning'])->only('update');
        $this->middleware(['permission:delete_elearning'])->only('destroy');
    }
    public function index()
    {
        return view('admin.elearning.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Elearning  $elearning
     * @return \Illuminate\Http\Response
     */
    public function show(Elearning $elearning)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Elearning  $elearning
     * @return \Illuminate\Http\Response
     */
    public function edit(Elearning $elearning)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Elearning  $elearning
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Elearning $elearning)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Elearning  $elearning
     * @return \Illuminate\Http\Response
     */
    public function destroy(Elearning $elearning)
    {
        //
    }
}