<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Enums\RenewalSM;
use App\Events\CustomerRenewalReminder;
use App\Renewal;
use Illuminate\Http\Request;

class CustomerManageRenewalsController extends Controller
{
    protected $rules = [
        'renewal_id.*' => 'required',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($token)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer, $token)
    {
        $this->authorize('manageRenewal', [$customer, $token]);

        $customer->load([
            'services' => function($q){
                $q->whereHas('renewalsExpiring')->with('serviceType', 'renewalsExpiring');
            }
        ]);

        return view('renewalsReminder.reminder', compact('customer', 'token'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Customer $customer, $token, Request $request)
    {
        $this->authorize('manageRenewal', [$customer, $token]);

        $this->validate($request, $this->rules);
        $renewalTransition = $request->only('renewal_id')['renewal_id'];

        $renewals = $customer->renewals()->with('service')->whereIn('renewals.id', array_keys($renewalTransition))->get();

        $renewals->each(function($renewal) use($renewalTransition){

            try {
                $renewal->transition($renewalTransition[$renewal->id]);
                $service = $renewal->service;

                if( // If the state is to_bill and doesn't exist a new renewal
                    $renewal->stateIs() == RenewalSM::S_to_bill &&
                    ($service->lastRenewalInsert()->deadline == $renewal->deadline)
                ){
                    logger("lo stato è da fatturare, provo a creare la nuova transazione");
                    $service->renewals()->create([
                        'deadline' => $service->calcNextDeadline(),
                        'amount' => $renewal->amount
                    ]);
                } elseif ( // If the state is S_suspended search next renewals for suspend them
                    $renewal->stateIs() == RenewalSM::S_suspended
                ){
                    $transitionToPerform = RenewalSM::T_suspend;
                    $service->renewals()->allNextFromDate($renewal)->get()->each( function($nextRenewal) use($transitionToPerform){
                        if($nextRenewal->transitionAllowed($transitionToPerform)){
                            try {
                                $nextRenewal->transition($transitionToPerform);
                            } catch(\Exception $e) {
                                return abort(500, $e->getMessage());
                            }
                        }
                    });
                }

            } catch(\Exception $e) {
                return abort(500, $e->getMessage());
            }
        });

        return redirect()->route('manage-renewals', ['customer'=>$customer, 'token'=>$token]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function sendManualReminder(Customer $customer)
    {
        $this->authorize('view', $customer);

        $customer->load([
            'services' => function($q){
                $q->whereHas('renewalsExpiring')->with('serviceType', 'renewalsExpiring');
            }
        ]);

        $message = [
            'type' => 'warning',
            'message' => 'Spiacenti, questo cliente non ha nessun servizio in scadenza',
        ];
        if($customer->services->isNotEmpty()){
            event(new CustomerRenewalReminder($customer));
            $message = [
                'message' => 'Promemoria inviato con successo',
            ];
        }

        return $message;
    }
}
