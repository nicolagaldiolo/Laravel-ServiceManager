<?php

use App\Enums\FrequencyRenewals;
use App\Enums\RenewalSM;

return [

    FrequencyRenewals::class => [
        FrequencyRenewals::Monthly => 'Mensile',
        FrequencyRenewals::HalfYearly => '6 mesi',
        FrequencyRenewals::Annual => 'Annuale',
        FrequencyRenewals::Biennial => '2 anni',
        FrequencyRenewals::Quinquennial => '5 anni',
    ],

    RenewalSM::class => [
        // States
        RenewalSM::S_to_confirm => 'Da confermare',
        RenewalSM::S_to_bill => 'Da fatturare',
        RenewalSM::S_to_cash => 'Da incassare',
        RenewalSM::S_payed => 'Pagato',
        RenewalSM::S_suspended => 'Sospeso',
        // Transitions
        RenewalSM::T_back_to_bill => 'Da fatturare',
        RenewalSM::T_back_to_cash => 'Da incassare',
        RenewalSM::T_back_to_confirm => 'Da confermare',
        RenewalSM::T_renews => 'Rinnova',
        RenewalSM::T_suspend => 'Sospendi',
        RenewalSM::T_invoice => 'Fatturato',
        RenewalSM::T_payed => 'Pagato',
    ],

];
