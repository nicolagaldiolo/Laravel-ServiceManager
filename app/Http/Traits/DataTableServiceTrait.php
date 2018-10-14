<?php

namespace App\Http\Traits;
use App\Enums\FrequencyRenewals;
use Carbon\Carbon;
use http\Env\Request;
use Yajra\DataTables\DataTables;

trait DataTableServiceTrait {

    public function getServicesDataTablesTraits($services) {

        return DataTables::of($services)
            ->editColumn('frequency', function ($service) {
                return FrequencyRenewals::getDescription($service->frequency);
            })
            ->editColumn('deadline', function ($service) {
                return $service->nextRenewal->deadlineVerbose;
                //return $service->renewals;
            })
            ->editColumn('amount', function ($service) {
                return $service->nextRenewal->amountVerbose;
                //return $service->renewals;
                //return ($service->renewals->currentDeadline) ? $service->renewals->currentDeadline->amountVerbose : "";
            })
            ->editColumn('status', function ($service) {
                return $service->nextRenewal->getStateAttributeVerbose();
            })
            //->editColumn('deadline', function ($domain) {
                //return $domain->deadline ? with(new Carbon($domain->deadline))->diffForHumans() : '';
            //    return $domain->deadline ? $domain->deadlineFormatted : '';
            //    return $domain->deadline ? $domain->deadlineFormatted : '';
            //})
            ->addColumn('actions', function($service){

                //$payedStatus = ($domain->payed === 1) ? 0 : 1;
                //$button = ($domain->deadline->lte(Carbon::now()->endOfMonth())) ? '<a data-status="' . $payedStatus . '" href="' . route('domains.payed.update', $domain) . '" class="setPayed btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-euro"></i></a>' : '';

                return implode("", [
                    '<a href="' . route('services.show', $service) . '" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-eye"></i></a>',
                    '<a href="' . route('services.destroy', $service) . '" class="deleteDataTableRecord btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></a>',
                    //$button
                ]);
            })->rawColumns(['status','actions'])->make(true);
    }
}
