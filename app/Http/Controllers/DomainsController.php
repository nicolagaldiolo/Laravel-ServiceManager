<?php

namespace App\Http\Controllers;

use App\Domain;
use App\ExpiringDomain;
use App\Http\Requests\DomainRequest;
use App\Http\Traits\DataTableDomainTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DomainsController extends Controller
{

    use DataTableDomainTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(request()->wantsJson() || request()->expectsJson()) {

            $domains = Auth::user()->domains()->with('domain', 'hosting')->get();
  
            return $this->getDomainsDataTablesTraits($domains);
        }
  
        return view('domains.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        $customers = Auth::user()->customers()->get();
        $providers = Auth::user()->providers()->get();
        $domain = new Domain;
        $expiring = false;

        if($req->has('cid')){
            $domain->customer_id = $req->input('cid');
        }

        return view('domains.create', compact('domain', 'providers', 'customers', 'expiring'));
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

        return redirect()->route('domains.index')
            ->with('status', 'Dominio creato con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Domain $domain)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Domain $domain)
    {

        $this->authorize('view', $domain);

        $expiring = $domain->deadline->lte(Carbon::now()->endOfMonth());
        $customers = Auth::user()->customers()->get();
        $providers = Auth::user()->providers()->get();
        $domain->load('domain', 'hosting', 'customer');

        return view('domains.edit', compact('providers', 'domain', 'customers', 'expiring'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DomainRequest $request, Domain $domain)
    {
        $this->authorize('update', $domain);
        $domain->update($request->validated());

        return redirect()->route('domains.index')
            ->with('status', 'Dominio aggiornato con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Domain $domain)
    {
        $this->authorize('delete', $domain);

        (bool) $res = $domain->delete();

        return [
            'message'   => $res ? 'Domain deleted' : 'Domain not deleted',
            'status'    => $res
        ];
    }

    public function payedUpdate(Request $request, Domain $domain){
        $this->authorize('update', $domain);
        (bool) $res = $domain->update(['payed' => $request->get('payed')]);
        return [
            'message'   => $res ? 'Domain updated' : 'Domain not updated',
            'status'    => $res
        ];
    }


}
