<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProviderRequest;
use App\Providers;

class ProvidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Auth()->user()->providers()->get();
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
    public function store(ProviderRequest $request)
    {
        $provider = Auth()->user()->providers()->create($request->validated());
        return $provider;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Providers $provider)
    {
        $this->authorize('view', $provider);
        return $provider;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProviderRequest $request, Providers $provider)
    {
        $this->authorize('update', $provider);
        $provider->update($request->validated());
        return $provider;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Providers $provider)
    {
        $this->authorize('delete', $provider);
        $provider->delete();
        return $provider;
    }
}
