<?php

namespace App\Http\Controllers;

use App\Renewal;
use App\Service;
use Illuminate\Http\Request;

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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Service $service, Renewal $renewal, $transition)
    {

        $this->authorize('update', $renewal);

        try {
            $renewal->transition($transition);

            if(request()->wantsJson() || request()->expectsJson()) {
                return [
                    'message' => 'Cambio di stato effettuato con successo'
                ];
            }

        } catch(\Exception $e) {
            logger($e);
            return abort(500, $e->getMessage());
        }

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

        if(request()->wantsJson() || request()->expectsJson()) {
            return [
                'message' => 'Renewal eliminato con successo'
            ];
        }
    }
}
