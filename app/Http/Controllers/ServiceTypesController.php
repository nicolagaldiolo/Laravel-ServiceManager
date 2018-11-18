<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceTypeRequest;
use App\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ServiceTypesController extends Controller
{

    public function __construct()
    {
        $this->middleware('onlyAjax', ['except' => 'index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->wantsJson() || request()->expectsJson()) {
            $serviceTypes = Auth::user()->serviceTypes()->get();
            return DataTables::of($serviceTypes)->addColumn('actions', function($serviceType){
                return implode("", [
                    '<a href="' . route('service-types.edit', $serviceType) . '" data-original-title="' . __('messages.edit_service_type') . '" class="edit btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-edit"></i></a>',
                    '<a href="' . route('service-types.destroy', $serviceType) . '" class="deleteDataTableRecord btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></a>',
                ]);
            })->rawColumns(['actions'])->make(true);
        }

        $serviceType = new ServiceType;

        return view('serviceTypes.index', compact('serviceType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $serviceType = new ServiceType;
        return [
            'view' => view( 'serviceTypes.create', compact('serviceType'))->render(),
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceTypeRequest $request)
    {
        $serviceType = auth()->user()->serviceTypes()->create($request->validated());

        return [
            'object' => $serviceType,
            'message' => __('messages.service_types_created_status')
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
    public function edit(ServiceType $serviceType)
    {
        $this->authorize('view', $serviceType);

        return [
            'view' => view( 'serviceTypes.edit', compact('serviceType'))->render(),
        ];

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceTypeRequest $request, ServiceType $serviceType)
    {
        $serviceType->update($request->validated());

        return [
            'message' => __('messages.service_types_update_status')
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceType $serviceType)
    {
        $this->authorize('delete', $serviceType);
        $serviceType->delete();

        return [
            'message' => trans_choice('messages.service_types_delete_status', 1)
        ];
    }

    public function destroyAll(Request $request)
    {
        $ids = explode(",",$request->ids);

        foreach ($ids as $id){
            Auth::user()->serviceTypes()->findOrFail($id)->delete();
        }

        return [
            'message' => trans_choice('messages.service_types_delete_status', count($ids))
        ];

    }
}
