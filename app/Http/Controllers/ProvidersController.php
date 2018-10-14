<?php

namespace App\Http\Controllers;

use App\Provider;
use App\Http\Requests\ProviderRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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

        if(request()->wantsJson() || request()->expectsJson()) {
            $providers = Auth::user()->providers()->get();

            return DataTables::of($providers)->addColumn('actions', function($provider){
                return implode("", [
                    '<a href="' . route('providers.edit', $provider) . '" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-edit"></i></a>',
                    '<a href="' . route('providers.destroy', $provider) . '" class="deleteDataTableRecord btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></a>',
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

        $provider = new Provider;

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

        return redirect()->route('providers.index')
            ->with('status', 'Provider creato con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
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
    public function update(ProviderRequest $request, Provider $provider)
    {
        $this->authorize('update', $provider);
        $provider->update($request->validated());

        return redirect()->route('providers.index')
            ->with('status', 'Provider aggiornato con successo');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        $this->authorize('delete', $provider);

        $provider->delete();

        if(request()->wantsJson() || request()->expectsJson()) {
            return [
                'message' => 'Provider eliminato con successo'
            ];
        }
    }

    public function destroyAll(Request $request)
    {
        $ids = explode(",",$request->ids);

        Auth::user()->providers()->whereIn('providers.id',$ids)->delete();

        return [
            'message' => 'Providers eliminati con successo'
        ];
    }
}
