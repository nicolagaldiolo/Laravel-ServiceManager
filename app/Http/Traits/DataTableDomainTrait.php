<?php

namespace App\Http\Traits;
use http\Env\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

trait DataTableDomainTrait {

    public function getDomainsDataTablesTraits($domains) {

        return DataTables::of($domains)
            ->editColumn('amount', function ($domain) {
                return $domain->amountFormatted;
            })
            //->editColumn('deadline', function ($domain) {
                //return $domain->deadline ? with(new Carbon($domain->deadline))->diffForHumans() : '';
            //    return $domain->deadline ? $domain->deadlineFormatted : '';
            //    return $domain->deadline ? $domain->deadlineFormatted : '';
            //})
            ->addColumn('actions', function($domain){

                $payedStatus = ($domain->payed === 1) ? 0 : 1;
                $button = ($domain->deadline->lte(Carbon::now()->endOfMonth())) ? '<a data-status="' . $payedStatus . '" href="' . route('domains.payed.update', $domain) . '" class="setPayed btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-euro"></i></a>' : '';

                return implode("", [
                    '<a href="' . route('domains.edit', $domain) . '" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-edit"></i></a>',
                    '<a href="' . route('domains.destroy', $domain) . '" class="delete btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></a>',
                    $button
                ]);
            })->rawColumns(['actions'])->make(true);
    }
}