<?php

use App\Enums\FrequencyRenewals;
use App\Enums\RenewalSM;
use App\Enums\UserType;

return [

    UserType::class => [
        UserType::User => 'User',
        UserType::Admin => 'Admin',
    ],

    FrequencyRenewals::class => [
        FrequencyRenewals::Weekly => 'Weekly',
        FrequencyRenewals::Monthly => 'Monthly',
        FrequencyRenewals::HalfYearly => '6 months',
        FrequencyRenewals::Annual => 'Annual',
        FrequencyRenewals::Biennial => '2 years',
        FrequencyRenewals::Triennial => '3 years',
        FrequencyRenewals::Quadrennial => '4 years',
        FrequencyRenewals::Quinquennial => '5 years',
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
