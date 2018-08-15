<?php

namespace App\Http\Controllers;

use App\Providers;
use App\Http\Requests\ProviderRequest;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ProvidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Auth()->user()->providers()->get();

        $providers = Auth::user()->providers()->get();

        if(request()->wantsJson() || request()->expectsJson()) {
            return DataTables::of($providers)->addColumn('actions', function($user){
                return implode("", [
                    '<a href="' . route('providers.edit', $user) . '" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-edit"></i></a>',
                    '<a href="' . route('providers.destroy', $user) . '" class="delete btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></a>',
                ]);
            })->rawColumns(['actions'])->make(true);
        }

        return view('providers.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $provider = new Providers;

        return view('providers.create', compact('provider'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProviderRequest $request)
    {
        Auth()->user()->providers()->create($request->validated());

        return redirect()->route('providers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Providers $provider)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Providers $provider)
    {
        $this->authorize('view', $provider);

        return view('providers.edit', compact('provider'));
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

        return redirect()->route('providers.index');

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

        (bool) $res = $provider->delete();

        return [
            'message'   => $res ? 'Provider deleted' : 'Provider not deleted',
            'status'    => $res
        ];
    }
}