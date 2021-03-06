<?php


return [
    'renewal' => [
        // class of your domain object
        'class' => App\Renewal::class,

        // name of the graph (default is "default")
        'graph' => 'renewal',

        // property of your object holding the actual state (default is "state")
        'property_path' => 'status',

        // list of all possible states
        'states' => [
            App\Enums\RenewalSM::S_to_confirm,
            App\Enums\RenewalSM::S_to_bill,
            App\Enums\RenewalSM::S_to_cash,
            App\Enums\RenewalSM::S_payed,
            App\Enums\RenewalSM::S_suspended,
        ],

        'states_attribute' => [
            App\Enums\RenewalSM::S_to_confirm => [
                'attr' => App\Enums\RenewalSM::S_to_confirm,
                'label' => 'pending'
            ],
            App\Enums\RenewalSM::S_to_bill => [
                'attr' => App\Enums\RenewalSM::S_to_bill,
                'label' => 'info'
            ],
            App\Enums\RenewalSM::S_to_cash => [
                'attr' => App\Enums\RenewalSM::S_to_cash,
                'label' => 'warning'
            ],
            App\Enums\RenewalSM::S_payed => [
                'attr' => App\Enums\RenewalSM::S_payed,
                'label' => 'success'
            ],
            App\Enums\RenewalSM::S_suspended => [
                'attr' => App\Enums\RenewalSM::S_suspended,
                'label' => 'danger'
            ]
        ],

        // list of all possible transitions
        'transitions' => [
            App\Enums\RenewalSM::T_back_to_bill => [
                'from' => [App\Enums\RenewalSM::S_to_cash],
                'to' => App\Enums\RenewalSM::S_to_bill,
                'icon' => 'la la-undo',
                'label' => 'secondary'
            ],
            App\Enums\RenewalSM::T_back_to_cash => [
                'from' => [App\Enums\RenewalSM::S_payed],
                'to' => App\Enums\RenewalSM::S_to_cash,
                'icon' => 'la la-undo',
                'label' => 'secondary'
            ],
            App\Enums\RenewalSM::T_back_to_confirm => [
                'from' => [App\Enums\RenewalSM::S_to_bill, App\Enums\RenewalSM::S_suspended],
                'to' => App\Enums\RenewalSM::S_to_confirm,
                'icon' => 'la la-undo',
                'label' => 'secondary'
            ],
            App\Enums\RenewalSM::T_suspend => [
                'from' =>  [App\Enums\RenewalSM::S_to_confirm],
                'to' => App\Enums\RenewalSM::S_suspended,
                'icon' => 'la la-close',
                'label' => 'secondary'
            ],
            App\Enums\RenewalSM::T_renews => [
                'from' => [App\Enums\RenewalSM::S_to_confirm],
                'to' => App\Enums\RenewalSM::S_to_bill,
                'icon' => 'la la-rotate-right',
                'label' => 'secondary'
            ],
            App\Enums\RenewalSM::T_invoice => [
                'from' =>  [App\Enums\RenewalSM::S_to_bill],
                'to' => App\Enums\RenewalSM::S_to_cash,
                'icon' => 'la la-file-text',
                'label' => 'secondary'
            ],
            App\Enums\RenewalSM::T_payed => [
                'from' => [App\Enums\RenewalSM::S_to_cash],
                'to' => App\Enums\RenewalSM::S_payed,
                'icon' => 'la la-money',
                'label' => 'secondary'
            ]
        ],

        // list of all callbacks
        'callbacks' => [
            // will be called when testing a transition
            'guard' => [],

            // will be called before applying a transition
            'before' => [],

            // will be called after applying a transition
            'after' => [],
        ],
    ]
];
