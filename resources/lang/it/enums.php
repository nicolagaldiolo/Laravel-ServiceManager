<?php

use App\Enums\RenewalFrequencies;
use App\Enums\RenewalSM;
use App\Enums\UserType;

return [

    UserType::class => [
        UserType::User => 'Utente',
        UserType::Admin => 'Amministratore',
    ],

    RenewalFrequencies::class => [
        RenewalFrequencies::Days => 'Giorni',
        RenewalFrequencies::Weeks => 'Settimane',
        RenewalFrequencies::Months => 'Mesi',
        RenewalFrequencies::Years => 'Anni'
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
