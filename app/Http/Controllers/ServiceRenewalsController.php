<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRenewalRequest;
use App\Renewal;
use App\Service;

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
            'view' => view('renewals._form', compact('renewal'))->render()
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
            'message' => 'Nuova scadenza creata con successo'
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
            'view' => view('renewals._form', compact('renewal'))->render()
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
            'message' => 'Rinnovo aggiornato con successo'
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
            'message' => 'Renewal eliminato con successo'
        ];
    }

    public function transition(Service $service, Renewal $renewal, $transition)
    {

        $this->authorize('update', $renewal);

        try {
            $renewal->transition($transition);
            return [
                'message' => 'Cambio di stato effettuato con successo'
            ];

        } catch(\Exception $e) {
            logger($e);
            return abort(500, $e->getMessage());
        }

    }

}
