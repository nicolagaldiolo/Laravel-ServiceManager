<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Service;
use App\Http\Requests\CustomerRequest;
use App\Http\Traits\DataTableServiceTrait;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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
                    '<a href="' . route('customers.destroy', $customer) . '" class="deleteDataTableRecord btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></a>',
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

        if(request()->wantsJson() || request()->expectsJson()) {
            return [
                'view' => view('customers.create_form', compact('customer', 'domain'))->render(),
            ];
        }

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
        $customer = Auth::user()->customers()->create($request->validated());
        $message = __('messages.customer_created_status');
        if(request()->wantsJson() || request()->expectsJson()) {
            return [
                'object' => $customer,
                'message' => $message
            ];
        }

        return redirect()->route('customers.index')
            ->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        $this->authorize('view', $customer);

        if(request()->wantsJson() || request()->expectsJson()) {
            $services = $customer->services()->with('renewalsUnresolved', 'nextRenewal', 'provider', 'customer', 'serviceType')->get();
            return $this->getServicesDataTablesTraits($services);
        }

        $totalUserServices = Auth::user()->services()->with('renewalsCurrent')->get()
            ->pluck('renewalsCurrent')->collapse()->sum('amount');

        $customerServices = $customer->load('services.renewalsCurrent', 'services.renewalsUnresolved');
        $customerServicesCount = $customerServices->services->count();
        $renewals = $customerServices->services->pluck('renewalsCurrent')->collapse();
        $renewalsUnresolved = $customerServices->services->pluck('renewalsUnresolved')->collapse();

        $renewalsThisMonth = $renewals->filter(function($item){
            return $item->deadline->month == Carbon::now()->month;
        });

        $revenue = $renewals->sum('amount');
        $revenueThisMonth= $renewalsThisMonth->sum('amount');
        $renewalsUnresolved = $renewalsUnresolved->count();
        $revenueAvarage = round($totalUserServices > 0 ? (($revenue * 100) / $totalUserServices) : 0, 2);

        return view('customers.show', compact('customer', 'customerServicesCount', 'revenue', 'revenueThisMonth', 'renewalsUnresolved', 'revenueAvarage'));

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
            ->with('status', __('messages.customer_update_status'));
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
                'message' => trans_choice('messages.customer_delete_status', 1),
            ];
        }
    }

    public function destroyAll(Request $request)
    {
        $ids = explode(",",$request->ids);

        foreach ($ids as $id){
            Auth::user()->customers()->findOrFail($id)->delete();
        }

        return [
            'message' => trans_choice('messages.customer_delete_status', count($ids)),
        ];

    }
}
