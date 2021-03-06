<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRenewalRequest;
use App\Renewal;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceRenewalsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Service $service)
    {
        // Create a new renewal object
        $renewal = new Renewal([
            'deadline' => $service->calcNextDeadline(),
            'amount' => $service->lastRenewalInsert()->amount
        ]);

        return [
            'view' => view('renewals.create', compact('renewal', 'service'))->render()
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRenewalRequest $request, Service $service)
    {
        $service->renewals()->create($request->validated());

        return [
            'message' => __('messages.renewal_created_status')
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service, Renewal $renewal)
    {
        $this->authorize('view', $renewal);

        return [
            'view' => view('renewals.edit', compact('service', 'renewal'))->render()
        ];

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(ServiceRenewalRequest $request, Service $service, Renewal $renewal)
    {
        $this->authorize('update', $renewal);
        $renewal->update($request->validated());

        return [
            'message' => __('messages.renewal_update_status')
        ];
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service, Renewal $renewal)
    {

        $this->authorize('delete', $renewal);
        $renewal->delete();

        return [
            'message' => trans_choice('messages.renewal_delete_status', 1)
        ];
    }

    public function destroyAll(Request $request, Service $service)
    {
        $ids = explode(",",$request->ids);

        foreach ($ids as $id){
            $service->renewals()->findOrFail($id)->delete();
        }

        return [
            'message' => trans_choice('messages.renewal_delete_status', count($ids))
        ];

    }

    public function transition(Service $service, Renewal $renewal, $transition)
    {

        $this->authorize('update', $renewal);

        try {
            $renewal->transition($transition);
            return [
                'message' => __('messages.renewal_transition_status')
            ];

        } catch(\Exception $e) {
            return abort(500, $e->getMessage());
        }

    }

}
