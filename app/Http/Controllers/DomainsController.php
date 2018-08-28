<?php

namespace App\Http\Controllers;


use App\Domains;
use App\Http\Requests\DomainRequest;
use App\Http\Traits\DataTableDomainTrait;
use App\Jobs\ExpiringDomains;
use App\Jobs\GetScreenshoot;
use App\Mail\ExipiringDomainsEmail;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
        $domain = new Domains;

        if($req->has('cid')){
            $domain->customer_id = $req->input('cid');
        }

        return view('domains.create', compact('domain', 'providers', 'customers'));
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

        $customers = Auth::user()->customers()->get();
        $providers = Auth::user()->providers()->get();
        $domain->load('domain', 'hosting', 'customer');

        return view('domains.edit', compact('providers', 'domain', 'customers'));
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

    public function payedUpdate(Request $request, Domains $domain){
        $this->authorize('update', $domain);
        (bool) $res = $domain->update(['payed' => $request->get('payed')]);
        return [
            'message'   => $res ? 'Domain updated' : 'Domain not updated',
            'status'    => $res
        ];
    }


}
