<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Service;
use App\Http\Requests\CustomerRequest;
use App\Http\Traits\DataTableServiceTrait;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{

    use DataTableServiceTrait;

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
        $domain = new Service;
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

        return redirect()->route('customers.index')
            ->with('status', 'Customer creato con successo');
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
            $services = $customer->services()->with('provider', 'customer', 'serviceType')->get();

            return $this->getServicesDataTablesTraits($services);

        }

        $customerServices = $customer->load('services');
        $customerServicesCount = $customerServices->services->count();
        $customerRevenue = 0;//$customerServices->services->sum('amount');
        $toPay = 0;//$customerServices->Services->filter(function($item){
            //return $item->payed === 0;
        //})->count();

        $revenueAvarage = 100;//round(($customerRevenue * 100) / Auth::user()->services()->sum('amount'), 2);

        return view('customers.show', compact('customer', 'customerRevenue', 'customerServicesCount', 'toPay', 'revenueAvarage'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $this->authorize('view', $customer);

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

        return redirect()->route('customers.index')
            ->with('status', 'Customer aggiornato con successo');
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
        $customer->delete();

        if(request()->wantsJson() || request()->expectsJson()) {
           return [
                'message' => 'Customer eliminato con successo'
            ];
        }

    }
}
