<?php

use App\Enums\FrequencyRenewals;
use App\Enums\RenewalSM;

return [

    FrequencyRenewals::class => [
        FrequencyRenewals::Monthly => 'Mensual',
        FrequencyRenewals::HalfYearly => '6 meses',
        FrequencyRenewals::Annual => 'Anual',
        FrequencyRenewals::Biennial => '2 años',
        FrequencyRenewals::Quinquennial => '5 años',
    ],

    RenewalSM::class => [
        // States
        RenewalSM::S_to_confirm => 'Para ser confirmado',
        RenewalSM::S_to_bill => 'A facturar',
        RenewalSM::S_to_cash => 'Para ser redimido',
        RenewalSM::S_payed => 'Pagado',
        RenewalSM::S_suspended => 'Suspendido',
        // Transitions
        RenewalSM::T_back_to_bill => 'A facturar',
        RenewalSM::T_back_to_cash => 'Para ser redimido',
        RenewalSM::T_back_to_confirm => 'Para ser confirmado',
        RenewalSM::T_renews => 'Renovar',
        RenewalSM::T_suspend => 'Suspender',
        RenewalSM::T_invoice => 'Proyecto de ley',
        RenewalSM::T_payed => 'Pagado',
    ],
];
