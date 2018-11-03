<?php

use App\Enums\RenewalFrequencies;
use App\Enums\RenewalSM;
use App\Enums\UserType;

return [

    UserType::class => [
        UserType::User => 'User',
        UserType::Admin => 'Admin',
    ],

    RenewalFrequencies::class => [
        RenewalFrequencies::Days => 'Days',
        RenewalFrequencies::Weeks => 'Weeks',
        RenewalFrequencies::Months => 'Months',
        RenewalFrequencies::Years => 'Years'
    ],

    RenewalSM::class => [
        // States
        RenewalSM::S_to_confirm => 'To be confirmed',
        RenewalSM::S_to_bill => 'To be invoiced',
        RenewalSM::S_to_cash => 'To cash in',
        RenewalSM::S_payed => 'Paid',
        RenewalSM::S_suspended => 'Suspended',
        // Transitions
        RenewalSM::T_back_to_bill => 'To be invoiced',
        RenewalSM::T_back_to_cash => 'To cash in',
        RenewalSM::T_back_to_confirm => 'To be confirmed',
        RenewalSM::T_renews => 'Renew',
        RenewalSM::T_suspend => 'Suspend',
        RenewalSM::T_invoice => 'Revenue',
        RenewalSM::T_payed => 'Paid',
    ],

];
