<?php

namespace App\Http\Controllers;

use App\Domain;
use App\Events\ToPayDomainsAlert;
use App\Events\GenerateScreen;
use App\Providers;
use App\Http\Requests\ProviderRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Ping;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dashboard = Auth()->user()->load('domains.customer', 'providers.domains', 'providers.hostings', 'customers.domains');

        $expiringDomains = $dashboard->domains->filter(function($item){
            return ($item->deadline->month == Carbon::today()->month) && ($item->deadline->year == Carbon::today()->year);
        });

        $dashboard['expiringDomains'] = $expiringDomains;
        $dashboard['monthlyService_percent'] = round(($expiringDomains->sum('amount') * 100) / $dashboard->domains->sum('amount'), 2);
        $domainsByMounth = collect(array_fill(1, 12, 0));

        $dashboard->domains->each(function($item) use($domainsByMounth){
            $domainsByMounth[$item->deadline->month] += $item->amount;
        });
        $dashboard['domainsByMounth'] = $domainsByMounth;

        $totalDomain = Domain::count();

        $usersSummary = User::with('domains')->get();
        $usersSummary->each(function($item) use($totalDomain){
            $item['domains_total_perc'] = round(($item->domains->count() * 100) / $totalDomain, 2);
        });

        $dashboard['usersSummary'] = $usersSummary;

        return view('dashboard.index', compact( 'dashboard'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
