<?php

use App\Enums\RenewalFrequencies;
use App\Enums\RenewalSM;
use App\Enums\UserType;

return [

    UserType::class => [
        UserType::User => 'Usuario',
        UserType::Admin => 'Administrador',
    ],

    RenewalFrequencies::class => [
        RenewalFrequencies::Days => 'Días',
        RenewalFrequencies::Weeks => 'Semanas',
        RenewalFrequencies::Months => 'Meses',
        RenewalFrequencies::Years => 'Años'
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
