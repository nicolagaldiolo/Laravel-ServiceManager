<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Domains;
use App\Http\Requests\CustomerRequest;
use App\Http\Traits\DataTableDomainTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
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

            $customers = Auth::user()->customers()->get();

            return DataTables::of($customers)->addColumn('actions', function($customer){
                return implode("", [
                    '<a href="' . route('customers.show', $customer) . '" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-eye"></i></a>',
                    '<a href="' . route('customers.edit', $customer) . '" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-edit"></i></a>',
                    '<a href="' . route('customers.destroy', $customer) . '" class="delete btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></a>',
                ]);
            })->rawColumns(['actions'])->make(true);
        }

        return view('customers.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = new Customer;
        $domain = new Domains;
        return view('customers.create', compact('customer', 'domain'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        Auth::user()->customers()->create($request->validated());

        return redirect()->route('customers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {

        if(request()->wantsJson() || request()->expectsJson()) {
            $domains = $customer->domains()->with('domain', 'hosting')->get();

            return $this->getDomainsDataTablesTraits($domains);

        }

        $userDomains = Auth::user()->domains()->get();
        $customerDomains = $userDomains->filter(function($item) use($customer){
            return $item->customer_id === $customer->id;
        });

        $toPay = $customerDomains->filter(function($item){
            return $item->payed === 0;
        })->count();

        $customerRevenue = $customerDomains->sum('amount');
        $customerDomainsCount = $customerDomains->count();
        $revenueAvarage = round(($customerRevenue * 100) / $userDomains->sum('amount'), 2);

        return view('customers.show', compact('customer', 'customerRevenue', 'customerDomainsCount', 'toPay', 'revenueAvarage'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $this->authorize('update', $customer);
        $customer->update($request->validated());

        return redirect()->route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $this->authorize('delete', $customer);

        (bool) $res = $customer->delete();

        return [
            'message'   => $res ? 'Domain deleted' : 'Domain not deleted',
            'status'    => $res
        ];
    }
}
