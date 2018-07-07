<?php

namespace App\Http\Controllers;

use App\Domains;
use App\Http\Requests\DomainRequest;
use Illuminate\Support\Facades\Auth;

class DomainsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Auth::user()->domains()->with('domain', 'hosting')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DomainRequest $request)
    {
        $domain = Auth::user()->domains()->create($request->validated());
        return $domain;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Domains $domain)
    {
        $this->authorize('view', $domain);
        $domain->load('domain', 'hosting');
        return $domain;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DomainRequest $request, Domains $domain)
    {

        $this->authorize('update', $domain);
        $domain->update($request->validated());

        return $domain;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Domains $domain)
    {
        $this->authorize('delete', $domain);

        $domain->delete();

        return $domain;
    }
}
