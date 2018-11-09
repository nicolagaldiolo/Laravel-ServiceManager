<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Enums\RenewalSM;
use App\Events\CheckServiceStatus;
use App\Events\CustomerRenewalReminder;
use App\Events\GenerateScreen;
use App\Events\ToPayServicesAlert;
use App\Mail\CustomerRenewalsReminder;
use App\Provider;
use App\Renewal;
use App\Service;
use App\ExpiringDomain;
use App\Http\Requests\ServiceRequest;
use App\Http\Traits\DataTableServiceTrait;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Jenssegers\Date\Date;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Yajra\DataTables\DataTables;

class ServicesController extends Controller
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
            $services = Auth::user()->services()->with('renewalsUnresolved','nextRenewal', 'provider', 'customer', 'serviceType')->get();
            return $this->getServicesDataTablesTraits($services);
        }

        return view('services.index');

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
        $service_types = Auth::user()->serviceTypes()->get();
        $renewal_frequencies = Auth::user()->renewalFrequencies()->get();
        $service = new Service;
        $renewal = new Renewal;

        if($req->has('cid')){
            $service->customer_id = $req->input('cid');
        }

        return view('services.create', compact('service', 'renewal', 'providers', 'service_types', 'renewal_frequencies', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        $renewal_field = [
            'amount',
            'deadline',
            'status'
        ];

        // Create the service
        $service = Service::create($request->except($renewal_field));

        // Create the renewal
        $current = $service->renewals()->create($request->only($renewal_field));

        // Create the next renewal
        if(
            $current->stateIs() != RenewalSM::S_suspended &&
            $current->stateIs() != RenewalSM::S_to_confirm
        ) {
            $service->renewals()->create([
                'deadline' => $service->calcNextDeadline(),
                'amount' => $current->amount
            ]);
        }

        return redirect()->route('services.show', $service)
            ->with('status', __('messages.service_created_status'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {

        if(request()->wantsJson() || request()->expectsJson()) {
            $renewals = $service->renewals()->orderBy('deadline', 'DESC')->get();

            return DataTables::of($renewals)
                ->editColumn('status', function ($renewal){
                    return $renewal->getStateAttributeVerbose();
                })
                ->setRowAttr([
                    'class' => function($renewal) {
                        return $renewal->unsolved ? "m-table__row--danger" : "";
                    },
                ])
                ->addColumn('actions', function($renewal) use($service){

                    $buttons = $renewal->getPossibleTransitions();
                    array_walk($buttons, function(&$k, $v) use($renewal, $service){
                        $k = '<a data-transition-default="' . RenewalSM::T_renews. '" data-transition="' . $v . '" href="' . route('services.renewals.transition', ['service'=>$service,'renewals'=>$renewal,'transition'=>$v]) . '" class="update-transition btn btn-sm m-btn m-btn--custom btn-' . $k['label'] . '"><i class="'. $k['icon'] . '"></i> ' . RenewalSM::getDescription($v) . '</a>';
                    });

                    $buttons[] = '<a href="' . route('services.renewals.edit', ['service'=>$service,'renewals'=>$renewal]) . '" data-original-title="' . __('messages.edit_renewal') . '" class="edit btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-edit"></i></a>';
                    $buttons[] = '<a href="' . route('services.renewals.destroy', ['service'=>$service,'renewals'=>$renewal]) . '" class="deleteDataTableRecord btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></a>';

                    return implode("", $buttons);

                })->rawColumns(['amount', 'status','actions'])->make(true);
        }else{

            $service->load('renewalsUnresolved', 'provider', 'customer', 'serviceType', 'renewalFrequency');

            return view('services.show', compact('service'));
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $this->authorize('view', $service);

        $customers = Auth::user()->customers()->get();
        $providers = Auth::user()->providers()->get();
        $service_types = Auth::user()->serviceTypes()->get();
        $renewal_frequencies = Auth::user()->renewalFrequencies()->get();
        $renewal = new Renewal;

        return view('services.edit', compact('service', 'renewal', 'providers', 'service_types', 'renewal_frequencies', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, Service $service)
    {
        $this->authorize('update', $service);

        $service->update($request->validated());

        return redirect()->route('services.show', $service)
            ->with('status', __('messages.service_update_status'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $this->authorize('delete', $service);

        $service->delete();

        if(request()->wantsJson() || request()->expectsJson()) {
            return [
                'message' => trans_choice('messages.service_delete_status', 1)
            ];
        }
    }

    public function destroyAll(Request $request)
    {

        $ids = explode(",",$request->ids);

         Auth::user()->services()->whereIn('services.id',$ids)->delete();

        return [
            'message' => trans_choice('messages.service_delete_status', count($ids))
        ];
    }

}
