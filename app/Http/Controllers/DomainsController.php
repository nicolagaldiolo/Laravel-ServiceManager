<?php

namespace App\Http\Controllers;

use App\Domains;
use App\Http\Requests\DomainRequest;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class DomainsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $domains = Auth::user()->domains()->with('domain', 'hosting')->get();

        if(request()->wantsJson() || request()->expectsJson()) {
            return DataTables::of($domains)->addColumn('actions', function($user){
                    return implode("", [
                        '<a href="' . route('domains.edit', $user) . '" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-edit"></i></a>',
                        '<a href="' . route('domains.destroy', $user) . '" class="delete btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></a>',
                    ]);
                })->rawColumns(['actions'])->make(true);
        }

        return view('domains.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $providers = Auth::user()->providers()->get();
        $domain = new Domains;

        return view('domains.create', compact('domain', 'providers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DomainRequest $request)
    {
        Auth::user()->domains()->create($request->validated());

        return redirect()->route('domains.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Domains $domain)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Domains $domain)
    {

        $this->authorize('view', $domain);

        $providers = Auth::user()->providers()->get();
        $domain->load('domain', 'hosting');

        return view('domains.edit', compact('providers', 'domain'));
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

        return redirect()->route('domains.index');
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

        (bool) $res = $domain->delete();

        return [
            'message'   => $res ? 'Domain deleted' : 'Domain not deleted',
            'status'    => $res
        ];
    }
}
