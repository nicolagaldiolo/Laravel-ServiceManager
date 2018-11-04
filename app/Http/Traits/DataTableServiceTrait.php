<?php

namespace App\Http\Traits;
use Carbon\Carbon;
use http\Env\Request;
use Yajra\DataTables\DataTables;

trait DataTableServiceTrait {

    public function getServicesDataTablesTraits($services) {

        return DataTables::of($services)
            ->editColumn('deadline', function ($service) {
                if($service->nextRenewal)
                    return $service->nextRenewal->deadlineVerbose;
                    //return $service->nextRenewal->deadlineVerbose;
            })
            ->editColumn('amount', function ($service) {
                if($service->nextRenewal)
                return amount_format($service->nextRenewal->amount);
            })
            ->editColumn('status', function ($service) {
                if($service->nextRenewal)
                return $service->nextRenewal->getStateAttributeVerbose();
            })
            ->editColumn('unresolved', function ($service){
                return $service->renewalsUnresolved->count();
            })
            ->addColumn('actions', function($service){
                return implode("", [
                    '<a href="' . route('services.show', $service) . '" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-eye"></i></a>',
                    '<a href="' . route('services.destroy', $service) . '" class="deleteDataTableRecord btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></a>'
                ]);
            })->rawColumns(['amount', 'status','actions'])->make(true);
    }
}
